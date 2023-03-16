import Button from "../componets/_button";
import Common from "../componets/_common";
import HttpService from "../http/_httpSevices";
import { IListCasinoDatas } from "../interfaces/_intercase-datas";
import { IArgsConfig } from "../interfaces/_interface-query-args";
import { CasinosResponse } from "../interfaces/_response";

class ListCasinos {
  http: HttpService;
  button: Button;
  common: Common;
  actions = {
    list_casinos    : 'list_casinos',
    gcode_decrement : 'gcode_decrement'
  };
  datas: IListCasinoDatas[] = [];
  classes = {
    list_casinos   : '.js-list-casinos',
    append_casinos : '.js-append-casinos',
    filter_form    : '.js-filter-form',
    filter_fields  : '.js-filter-change',
    reset_btns     : '.js-reset-filter',
    loadmore       : '.js-casinos-loadmore',
    cta            : '.js-list-cta',
    loader         : '.js-loader',
    gcode_btn      : '.js-gcode-btn',
    gcode_limit    : '.js-gcode-limit',
    show_bonuses   : '.js-show-bonuses'
  };
  listCasinos     : HTMLDivElement[]                         = [];
  appendCasinos   : HTMLDivElement[]                         = [];
  btnsMore        : HTMLButtonElement[]                      = [];
  resetBtns       : HTMLButtonElement[][]                    = [];
  changeMore      : (HTMLInputElement | HTMLSelectElement)[] = [];
  loaders         : HTMLElement[]                            = [];
  gcodeBtns       : HTMLAnchorElement[]                      = [];
  showBonusesBtns : HTMLButtonElement[]                      = [];
  clickCount      : number[]                                 = [];
  clickTypes      : ('module' | 'args')[]                    = [];

  constructor() {
    this.http = new HttpService();
    this.button = new Button();
    this.common = new Common();
    this.button.state('.js-cf-filter-expand');
    this.listCasinos = [].slice.call(document.querySelectorAll(this.classes.list_casinos));

    this.getDatas();
    this.onClickLoadMore();
    this.onChangeFilter();
    this.onClickResetFilter();
    this.onClickGCodeBtn();
    this.onClickShowBonuses(this.showBonusesBtns);
  }

  getDatas() {
    if (this.listCasinos) {
      this.gcodeBtns = [].slice.call(document.querySelectorAll(this.classes.gcode_btn));
      this.showBonusesBtns = [].slice.call(document.querySelectorAll(this.classes.show_bonuses));

      this.listCasinos.map((list: HTMLElement) => {
        this.setData(list);
      });
    }
  }

  getCasinos(data: { action: string, data: Record<string, unknown> }, i: number) {
    this.http.request("post", data).
      then((res) => {
        const data: CasinosResponse = JSON.parse(res.data);
        this.appendCasinos[i].insertAdjacentHTML('beforeend', data.html);
        this.loaders[i].style.display = 'none';
        this.onClickShowBonuses([].slice.call(this.listCasinos[i].querySelectorAll(this.classes.show_bonuses)));
        if (data.more) {
          this.btnsMore[i].style.display = null;
        } else {
          const cta = this.listCasinos[i].querySelector(this.classes.cta) as HTMLAnchorElement;

          if (cta) {
            cta.style.display = null;
          }
        }
        if (window.vars.sticky) {
          window.vars.sticky.update();
        }
      })
      .catch((error) => {
        console.log(error);
      });
  }

  setData(list: HTMLElement) {
    const args: IArgsConfig = JSON.parse(list.dataset.args);
    this.datas.push({
      view: list.dataset.view,
      slider: list.dataset.slider,
      page_posts: parseInt(list.dataset.page_posts),
      total_posts: parseInt(list.dataset.total_posts),
      args: args,
      ordered: !!list.dataset.ordered,
      module: {
        post_type: 'post',
        post_status: 'publish',
        list_type: '3',
        offset: 0,
        order_by: args.orderby,
        number_of_results: -1,
        meta_query: args.meta_query,
        results_per_page: parseInt(list.dataset.page_posts)
      }
    });
    this.appendCasinos.push(list.querySelector(this.classes.append_casinos));
    this.btnsMore.push(list.querySelector(this.classes.loadmore));
    this.loaders.push(list.querySelector(this.classes.loader));

    this.changeMore.push([].slice.call(list.querySelectorAll(this.classes.filter_fields)));
    this.resetBtns.push([].slice.call(list.querySelectorAll(this.classes.reset_btns)));
  }

  setClickLoadMore(btn: HTMLButtonElement, i: number) {
    if (btn) {
      this.clickTypes[i] = 'args';
      this.clickCount[i] = 0;

      btn.addEventListener('click', () => {
        this.clickCount[i]++;
        this.beforeGetCasinos(i)
      });
    }
  }

  setChangeFilter(items, i: number) {
    if (items) {
      items.forEach((item: HTMLFormElement) => {
        item.addEventListener('change', () => {
          const list = this.listCasinos[i];
          const form = list.querySelector('form');
          this.appendCasinos[i].innerHTML = '';
          if (this.isEmptyFilter(form)) {
            this.resetFilter(i);
          } else {
            const cta: HTMLElement = list.querySelector(this.classes.cta);

            if (cta) {
              cta.style.display = 'none';
            }
            this.clickCount[i] = 0;
            this.clickTypes[i] = 'module';
            this.datas[i].module[item.name] = item.value;

            this.resetBtns[i].map((btn: HTMLButtonElement) => btn.style.display = null);
          }

          this.beforeGetCasinos(i);
        })
      });
    }
  }

  setResetFilter(items, i: number) {
    if (items) {
      items.forEach((btn: HTMLButtonElement) =>
        btn.addEventListener('click', () => {
          this.appendCasinos[i].innerHTML = '';
          this.resetFilter(i);
          this.beforeGetCasinos(i);
        })
      );
    }
  }

  beforeGetCasinos(i) {
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

    this.getCasinos({
      action: this.actions.list_casinos,
      data: {
        args: this.clickTypes[i] === 'args' ? JSON.stringify(this.datas[i].args) : JSON.stringify(this.datas[i].module),
        type: this.clickTypes[i],
        view: this.datas[i].view,
        slider: this.datas[i].slider,
        ordered: this.datas[i].ordered,
        total: this.clickTypes[i] === 'args' ? this.datas[i].total_posts : this.datas[i].module.number_of_results,
      }
    }, i);
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
    const list = this.listCasinos[i];
    const form = list.querySelector(this.classes.filter_form) as HTMLFormElement;
    const resetBtns = [].slice.call(list.querySelectorAll(this.classes.reset_btns));
    const cta = list.querySelector(this.classes.cta) as HTMLAnchorElement;

    this.clickCount[i] = 0;
    this.clickTypes[i] = 'args';
    if (cta) {
      cta.style.display = 'none';
    }
    form.reset();
    resetBtns.forEach((btn: HTMLButtonElement) => btn.style.display = 'none');
  }

  onClickLoadMore() {

    if (this.btnsMore) {
      this.btnsMore.forEach((btn: HTMLButtonElement, i: number) => {
        this.setClickLoadMore(btn, i);
      });
    }
  }

  onChangeFilter() {

    if (this.changeMore) {
      this.changeMore.forEach((items, i: number) => {
        this.setChangeFilter(items, i);
      });
    }
  }

  onClickResetFilter() {
    if (this.resetBtns) {
      this.resetBtns.forEach((items, i: number) => {
        this.setResetFilter(items, i);
      })
    }
  }

  onClickGCodeBtn() {
    if (this.gcodeBtns.length) {
      this.gcodeBtns.map(btn =>
        btn.addEventListener('click', () => {
          const post_id = btn.dataset.post;
          this.http.request('get', {
            action: this.actions.gcode_decrement,
            data: { post_id }
          })
            .then(res => {
              const gcode_limit = btn.querySelector(this.classes.gcode_limit);
              if (parseInt(res.data) > 0) {
                gcode_limit.textContent = res.data;
              } else {
                btn.remove();
              }
            })
            .catch(err => console.log(err));
        })
      );
    }
  }

  onClickShowBonuses(bonuses) {
    if (bonuses.length) {
      bonuses.map(btn => {
        if (!btn.classList.contains('loaded')) {
          btn.classList.add('loaded');
          btn.addEventListener('click', () => {
            const parent = btn.closest('div') as HTMLDivElement;
            const listItem = btn.closest('.cl') as HTMLDivElement;
            const bonuses = [].slice.call(parent.querySelectorAll('.cl__bonus__item'));
            const speed = 300;
            let totalHeight = 0;

            if (!btn.classList.contains('active')) {
              btn.classList.add('active');
              if (window.innerWidth > 767) {
                parent.style.height = parent.clientHeight + 'px';
              }
              listItem.style.height = listItem.clientHeight + 'px';
              bonuses.map((bonus: HTMLDivElement, i: number) => {
                if (i > 0) {
                  totalHeight += bonus.scrollHeight;
                  bonus.style.height = bonus.scrollHeight + 'px';
                }
              });
              listItem.style.height = (listItem.clientHeight + totalHeight - 10) + 'px';
            } else {
              btn.classList.remove('active');
              bonuses.reverse().map((bonus: HTMLDivElement, i: number) => {
                if (i < bonuses.length - 1) {
                  bonus.style.height = '0';
                  totalHeight += bonus.scrollHeight;
                }
              });
              listItem.style.height = (listItem.clientHeight - totalHeight + 10) + 'px';
              setTimeout(() => {
                bonuses.map(bonus => bonus.style.height = null);
                listItem.style.height = null;
                parent.style.height = null;
              }, speed);
            }
          })
        }
      });
    }
  }
}

new ListCasinos();
