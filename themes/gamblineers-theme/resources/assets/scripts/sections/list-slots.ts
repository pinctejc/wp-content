import Button from "../componets/_button";
import HttpService from "../http/_httpSevices";
import { IListSlotsDatas } from "../interfaces/_intercase-datas";
import { IArgsConfig } from "../interfaces/_interface-query-args";
import { SlotsResponse } from "../interfaces/_response";

class ListSlots {
  http: HttpService;
  button: Button;
  action = 'list_slots';
  datas: IListSlotsDatas[] = [];
  listSlotsClass = '.js-list-slots';
  resetBtnsClass = '.js-reset-filter';
  listSlots = [].slice.call(document.querySelectorAll(this.listSlotsClass));
  appendSlots = [];
  btnsMore = [];
  resetBtns = [];
  changeMore = [];
  loaders = [];
  clickCount: number[] = [];
  clickTypes: ('module' | 'args')[] = [];
  timer: any;

  constructor() {
    this.http = new HttpService();
    this.button = new Button();
    this.button.state('.js-lsf-filter-expand');
    this.getDatas();
    this.onClickLoad();
    this.onChangeLoad();
    this.onClickReset();
  }

  getDatas() {
    if (this.listSlots) {
      this.listSlots.forEach((list: HTMLElement) => {
        const args: IArgsConfig = JSON.parse(list.dataset.args);
        this.datas.push({
          page_posts: parseInt(list.dataset.page_posts),
          total_posts: parseInt(list.dataset.total_posts),
          args: args,
          module: {
            post_type: 'slot',
            post_status: 'publish',
            list_type: '3',
            offset: 0,
            order_by: args.orderby,
            number_of_results: -1,
            results_per_page: parseInt(list.dataset.page_posts)
          }
        })

        this.appendSlots.push(list.querySelector('.js-append-slots'));
        this.btnsMore.push(list.querySelector('.js-slots-loadmore'));
        this.loaders.push(list.querySelector('.js-loader'));

        const ChangeFields = [].slice.call(list.querySelectorAll('.js-filter-change'));
        const resetBtns = [].slice.call(list.querySelectorAll(this.resetBtnsClass));

        ChangeFields.forEach(field => this.changeMore.push(field));
        resetBtns.forEach(btn => this.resetBtns.push(btn));
      });
    }
  }

  getSlots(data: { action: string, data: Record<string, unknown> }, i: number) {
    this.http.request("post", data).
      then((res) => {
        const data: SlotsResponse = JSON.parse(res.data);
        this.appendSlots[i].insertAdjacentHTML('beforeend', data.html);
        this.loaders[i].style.display = 'none';

        if (data.more) {
          this.btnsMore[i].style.display = null;
        } else {
          const cta = this.listSlots[i].querySelector('.js-list-cta');
          
          if (cta) {
            cta.style.display = null;
          }
        }
      })
      .catch(error => {
        console.log(error);
      });
  }

  beforeGetSlots(i) {
    const offset: number = this.datas[i].page_posts * this.clickCount[i];
    
    this.btnsMore[i].style.display = 'none';
    this.loaders[i].style.display = 'block';

    if (2 * offset >= this.datas[i].total_posts && this.datas[i].total_posts > 0) {
      this.datas[i].args.posts_per_page = this.datas[i].total_posts - offset;
    }

    if (this.clickTypes[i] === 'args') {
      this.datas[i].args.offset = offset;
    }

    if (this.clickTypes[i] === 'module') {
      this.datas[i].module.offset = offset;
    }

    this.getSlots({
      action: this.action,
      data: {
        args: this.clickTypes[i] === 'args' ? JSON.stringify(this.datas[i].args) : JSON.stringify(this.datas[i].module),
        type: this.clickTypes[i],
        total: this.clickTypes[i] === 'args' ? this.datas[i].total_posts : this.datas[i].module.number_of_results,
      }
    }, i)
  }

  isEmptyFilter = function (form) {
    const formData = new FormData(form);
    let empty = true;
    formData.forEach(value => {
      if (value !== '') empty = false;
    });

    return empty;
  };

  resetFilter(i) {
    const list = this.listSlots[i];
    const form = list.querySelector('.js-filter-form');
    const resetBtns = [].slice.call(list.querySelectorAll(this.resetBtnsClass));
    const cta = list.querySelector('.js-list-cta');

    this.clickCount[i] = 0;
    this.clickTypes[i] = 'args';
    if (cta) {
      cta.style.display = 'none';
    }
    form.reset();
    resetBtns.forEach((btn: HTMLButtonElement) => btn.style.display = 'none');
  }

  onClickLoad() {

    if (this.btnsMore) {
      this.btnsMore.forEach((btn: HTMLButtonElement, i: number) => {
        this.clickTypes.push('args');
        this.clickCount.push(0);

        btn.addEventListener('click', () => {
          this.clickCount[i]++;
          this.beforeGetSlots(i);
        });
      });
    }
  }

  onClickReset() {
    if (this.resetBtns) {
      this.resetBtns.forEach((btn: HTMLButtonElement) =>
        btn.addEventListener('click', () => {
          const list = btn.closest(this.listSlotsClass) as HTMLElement;
          const i = this.listSlots.indexOf(list);
          this.appendSlots[i].innerHTML = '';
          this.resetFilter(i);
          this.beforeGetSlots(i);
        })
      );
    }
  }

  changeLoad(item) {
    const list = item.closest(this.listSlotsClass) as HTMLElement;
    const form = list.querySelector('form');
    const i = this.listSlots.indexOf(list);
    this.appendSlots[i].innerHTML = '';
    if (this.isEmptyFilter(form)) {
      this.resetFilter(i);
    } else {
      const resetBtns = list.querySelectorAll(this.resetBtnsClass);
      const cta: HTMLElement = list.querySelector('.js-list-cta');

      if (cta) {
        cta.style.display = 'none';
      }
      this.clickCount[i] = 0;
      this.clickTypes[i] = 'module';
      this.datas[i].module[item.name] = item.value;
      
      resetBtns.forEach((btn: HTMLButtonElement) => btn.style.display = null);
    }

    this.beforeGetSlots(i);
  }

  onChangeLoad() {

    if (this.changeMore) {
      this.changeMore.forEach((item: HTMLFormElement) => {
        this.timer = 0;
        if (item.type === 'text') {
          item.addEventListener('keyup', () => {
            clearTimeout(this.timer);
            this.timer = setTimeout(() => {
              this.changeLoad(item);
            }, 500);
          }); 
        } else {
          item.addEventListener('change', () => {
            this.changeLoad(item);
          });
        }
      });
    }
  }
}

new ListSlots();