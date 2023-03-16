import HttpService from "../http/_httpSevices";
import { IListNewsDatas } from "../interfaces/_intercase-datas";
import { IArgsConfig } from "../interfaces/_interface-query-args";
import { NewsResponse } from "../interfaces/_response";

class ListNews {
  http: HttpService;
  action = 'list_news';
  datas: IListNewsDatas[] = [];
  listNewsClass = '.js-list-news';
  listNews = [].slice.call(document.querySelectorAll('.js-list-news'));
  btnsCat = [];
  btnsMore = [];
  appendNews = [];
  loaders = [];
  clickTypes: ('module' | 'args')[] = [];
  clickCount: number[] = [];

  constructor() {
    this.http = new HttpService();
    this.getDatas();
    this.onClickLoad();
    this.onClickCat();
  }

  getDatas() {
    if (this.listNews) {
      this.listNews.forEach((list: HTMLElement) => {
        const args: IArgsConfig = JSON.parse(list.dataset.args);
        this.datas.push({
          page_posts: parseInt(list.dataset.page_posts),
          total_posts: parseInt(list.dataset.total_posts),
          args: args,
          view: list.dataset.view,
          module: {
            post_type: 'news',
            post_status: 'publish',
            list_type: '3',
            offset: 0,
            categories: null,
            order_by: args.orderby,
            number_of_results: -1,
            results_per_page: parseInt(list.dataset.page_posts)
          }
        });

        this.btnsCat.push([].slice.call(list.querySelectorAll('.js-cat-btn')));
        this.appendNews.push(list.querySelector('.js-append-news'));
        this.btnsMore.push(list.querySelector('.js-news-loadmore'));
        this.loaders.push(list.querySelector('.js-loader'));
      });
    }
  }

  getNews(data: { action: string, data: Record<string, unknown> }, i: number) {
    this.http.request("post", data).
      then((res) => {
        const data: NewsResponse = JSON.parse(res.data);
        this.appendNews[i].insertAdjacentHTML('beforeend', data.html);
        this.loaders[i].style.display = 'none';

        if (data.more) {
          this.btnsMore[i].style.display = null;
        } else {
          const cta = this.listNews[i].querySelector('.js-list-cta');

          if (cta) {
            cta.style.display = null;
          }
        }

        if (window.vars.sticky) {
          window.vars.sticky.update();
        }
      })
      .catch(error => {
        console.log(error);
      })
  }

  beforeGetNews(i) {
    const offset: number = this.datas[i].args.posts_per_page * this.clickCount[i];
    if (this.btnsMore[i]) {
      this.btnsMore[i].style.display = 'none';
    }
    this.loaders[i].style.display = 'block';
    this.datas[i].args.offset = offset;

    if (2 * offset >= this.datas[i].total_posts && this.datas[i].total_posts > 0) {
      this.datas[i].args.posts_per_page = this.datas[i].total_posts - offset;
    }

    if (this.clickTypes[i] === 'args') {
      this.datas[i].args.offset = offset;
    }

    if (this.clickTypes[i] === 'module') {
      this.datas[i].module.offset = offset;
    }

    this.getNews({
      action: this.action,
      data: {
        args: this.clickTypes[i] === 'args' ? JSON.stringify(this.datas[i].args) : JSON.stringify(this.datas[i].module),
        total: this.clickTypes[i] === 'args' ? this.datas[i].total_posts : this.datas[i].module.number_of_results,
        view: this.datas[i].view,
        type: this.clickTypes[i],
      }
    }, i)
  }

  onClickLoad() {

    if (this.btnsMore.length) {
      this.btnsMore.forEach((btn: HTMLButtonElement, i: number) => {
        if (btn) {
          this.clickTypes[i] = 'args';
          this.clickCount[i] = 0;

          btn.addEventListener('click', () => {
            this.clickCount[i]++;
            this.beforeGetNews(i);
          });
        }
      });
    }
  }

  onClickCat() {

    if (this.btnsCat) {
      this.btnsCat.forEach((btns: HTMLButtonElement[], i: number) => {
        btns.forEach((btn: HTMLButtonElement) => {
          btn.addEventListener('click', () => {
            if (!btn.classList.contains('active')) {
              if ( btn.dataset.term !== '') {
                this.clickTypes[i] = 'module';
                this.datas[i].module.categories = btn.dataset.term;
              } else {
                this.clickTypes[i] = 'args';
              }

              btns.forEach(btn => {
                if (btn.classList.contains('active')) {
                  btn.classList.remove('active');
                }
              });
              btn.classList.add('active');
              this.appendNews[i].innerHTML = '';
              this.clickCount[i] = 0;
              this.beforeGetNews(i);
            }
          })
        })
      });
    }
  }
}

new ListNews();
