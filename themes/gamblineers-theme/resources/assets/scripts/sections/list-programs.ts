import HttpService from "../http/_httpSevices";
import { IArgsConfig } from "../interfaces/_interface-query-args";
import { ProgramsResponse } from "../interfaces/_response";

class ListPrograms {
  http: HttpService;
  action = 'list_programs';
  hidden = false;
  clickCount = 0;
  btnMore: HTMLBodyElement = document.querySelector('.js-programs-loadmore');
  appendPrograms: HTMLElement = document.querySelector('.js-append-programs');

  constructor() {
    this.http = new HttpService();
    this.onClickLoad();
  }

  getPrograms(data: { action: string, data: string }) {
    this.http.request("post", data).
      then((res) => {
        const data: ProgramsResponse = JSON.parse(res.data);
        this.btnMore.hidden = this.hidden;
        this.appendPrograms.insertAdjacentHTML('beforeend', data.html);
      })
      .catch(error => {
        console.log(error);
      })
  }

  onClickLoad() {
    if (this.btnMore) {
      this.btnMore.addEventListener('click', event => {
        const target: HTMLButtonElement = (event.target as HTMLButtonElement);
        let args: IArgsConfig = JSON.parse(target.dataset.args);
        const total: number = parseInt(target.dataset.total);
        this.clickCount++;
        const offset = args.posts_per_page * this.clickCount;
  
        target.hidden = true;
        args = { offset: offset, ...args };
  
        if (2 * offset >= total) {
          this.hidden = true;
          args.posts_per_page = total - offset;
        }
  
        this.getPrograms({
          action: this.action,
          data: JSON.stringify(args)
        })
      });
    }
  }
}

new ListPrograms();