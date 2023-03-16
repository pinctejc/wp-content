import HttpService from "../http/_httpSevices";
import { IListGamesDatas } from "../interfaces/_intercase-datas";
import { IArgsConfig } from "../interfaces/_interface-query-args";
import { GamesResponse } from "../interfaces/_response";

class ListGames {
  http: HttpService;
  action = 'list_game_types';
  datas: IListGamesDatas[] = [];
  listGamesClass = '.js-list-games';
  listGames = [].slice.call(document.querySelectorAll(this.listGamesClass));
  btnsMore = [];
  appendGames = [];
  loaders = [];
  clickCount: number[] = [];

  constructor() {
    this.http = new HttpService();
    this.getDatas();
    this.onClickLoad();
  }


  getDatas() {
    if (this.listGames) {
      this.listGames.forEach((list: HTMLElement) => {
        const args: IArgsConfig = JSON.parse(list.dataset.args);
        this.datas.push({
          page_posts: parseInt(list.dataset.page_posts),
          total_posts: parseInt(list.dataset.total_posts),
          found_posts: parseInt(list.dataset.found_posts),
          view: list.dataset.view,
          args: args,
        })

        this.appendGames.push(list.querySelector('.js-append-games'));
        this.btnsMore.push(list.querySelector('.js-games-loadmore'));
        this.loaders.push(list.querySelector('.js-loader'));
      });
    }
  }

  getGames(data: { action: string, data: Record<string, unknown> }, i: number) {
    this.http.request("post", data).
      then((res) => {
        const data: GamesResponse = JSON.parse(res.data);
        this.appendGames[i].insertAdjacentHTML('beforeend', data.html);
        this.loaders[i].style.display = 'none';

        if (data.more) {
          this.btnsMore[i].style.display = null;
        } else {
          const cta = this.listGames[i].querySelector('.js-list-cta');
          
          if (cta) {
            cta.style.display = null;
          }
        }
      })
      .catch(error => {
        console.log(error);
      })
  }

  beforeGetGames(i) {
    const offset: number = this.datas[i].args.number * this.clickCount[i];
    this.btnsMore[i].style.display = 'none';
    this.loaders[i].style.display = 'block';
    this.datas[i].args.offset = offset;

    if (offset + this.datas[i].page_posts >= this.datas[i].total_posts && this.datas[i].total_posts > 0) {
      this.datas[i].args.number = this.datas[i].total_posts - offset;
    }

    this.getGames({
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
          this.beforeGetGames(i);
        });
      });
    }
  }
}

new ListGames();