import HttpService from "../http/_httpSevices";
import { IListProvidersDatas } from "../interfaces/_intercase-datas";
import { IArgsConfig } from "../interfaces/_interface-query-args";
import { ProvidersResponse } from "../interfaces/_response";

class ListProviders {
  http: HttpService;
  action = 'list_providers';
  datas: IListProvidersDatas[] = [];
  listProvidersClass = '.js-list-providers';
  listProviders = [].slice.call(document.querySelectorAll(this.listProvidersClass));
  btnsMore = [];
  appendProviders = [];
  loaders = [];
  clickCount: number[] = [];

  constructor() {
    this.http = new HttpService();
    this.getDatas();
    this.onClickLoad();
  }


  getDatas() {
    if (this.listProviders) {
      this.listProviders.forEach((list: HTMLElement) => {
        const args: IArgsConfig = JSON.parse(list.dataset.args);
        this.datas.push({
          page_posts: parseInt(list.dataset.page_posts),
          total_posts: parseInt(list.dataset.total_posts),
          found_posts: parseInt(list.dataset.found_posts),
          view: list.dataset.view,
          args: args,
        })

        this.appendProviders.push(list.querySelector('.js-append-providers'));
        this.btnsMore.push(list.querySelector('.js-providers-loadmore'));
        this.loaders.push(list.querySelector('.js-loader'));
      });
    }
  }

  getProviders(data: { action: string, data: Record<string, unknown> }, i: number) {
    this.http.request("post", data).
      then((res) => {
        const data: ProvidersResponse = JSON.parse(res.data);
        this.appendProviders[i].insertAdjacentHTML('beforeend', data.html);
        this.loaders[i].style.display = 'none';

        if (data.more) {
          this.btnsMore[i].style.display = null;
        } else {
          const cta = this.listProviders[i].querySelector('.js-list-cta');
          
          if (cta) {
            cta.style.display = null;
          }
        }
      })
      .catch(error => {
        console.log(error);
      })
  }

  beforeGetProviders(i) {
    const offset: number = this.datas[i].args.number * this.clickCount[i];
    this.btnsMore[i].style.display = 'none';
    this.loaders[i].style.display = 'block';
    this.datas[i].args.offset = offset;

    if (offset + this.datas[i].page_posts >= this.datas[i].total_posts && this.datas[i].total_posts > 0) {
      this.datas[i].args.number = this.datas[i].total_posts - offset;
    }

    this.getProviders({
      action: this.action,
      data: {
        args: JSON.stringify(this.datas[i].args),
        total: this.datas[i].total_posts,
        found: this.datas[i].found_posts,
        view: this.datas[i].view
      }
    }, i)
  }

  onClickLoad() {

    if (this.btnsMore) {
      this.btnsMore.forEach((btn: HTMLButtonElement, i: number) => {
        this.clickCount.push(0);

        btn.addEventListener('click', () => {
          this.clickCount[i]++;
          this.beforeGetProviders(i);
        });
      });
    }
  }
}

new ListProviders();