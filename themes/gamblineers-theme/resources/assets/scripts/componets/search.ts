import HttpService from "../http/_httpSevices";
import { ISearchSuggestions } from "../interfaces/_intercase-datas";
import { SearchSuggestions } from "../interfaces/_response";


class Search {
  body: HTMLBodyElement = document.querySelector('body');
  searchForm: HTMLDetailsElement = document.querySelector('.sf');
  searchInput: HTMLInputElement;
  searchHeaderBtn: HTMLButtonElement;
  searchHomeBtn: HTMLButtonElement[];
  listener = false;
  action = 'seach_suggestions';
  data: ISearchSuggestions;
  http: HttpService

  constructor() {
    if (this.searchForm) {
      this.http = new HttpService;
      this.searchInput = this.searchForm.querySelector('input');
      this.searchHeaderBtn = document.querySelector('.js-search-header');
      this.searchHomeBtn = [].slice.call(document.querySelectorAll('.js-home-search'));
      this.searchHeader();
      // this.searchHome();
      this.closeTargetSearch();
      this.searchSuggestions(this.searchInput);
      // this.closeSrollSearch();
    }
  }

  searchHeader() {
    this.searchHeaderBtn.addEventListener('click', () => {
      if (this.body.classList.contains('sho') || this.body.classList.contains('shs')) {
        this.closeSearch();
      }
      else {
        this.body.classList.add('sho');
        this.searchInput.focus();
      }
    });
  }

  searchHome() {
    this.searchHomeBtn.forEach((btn: HTMLButtonElement) => {
      btn.addEventListener('click', () => {
        if (this.body.classList.contains('sho')) {
          this.closeSearch()
        }
        else {
          this.body.classList.add('shs');
          this.searchInput.focus();

          // if (window.innerWidth > 767) {
          //   this.searchForm.style.top = btn.offsetTop + 'px';
          // }
        }
      });
    });
  }

  closeTargetSearch() {
    document.addEventListener('click', (e) => {
      const target = e.target as HTMLElement;
      if (!target.classList.contains('sf') && !target.classList.contains('hh__form') && !target.closest('.sf') && !target.closest('.hh__form') && !target.closest('.js-search-header') && !target.closest('.js-home-search')) {
        this.closeSearch();
      }
    });
  }

  closeSrollSearch() {
    document.addEventListener('scroll', () => {
      let offset = 0;

      if (parseInt(this.searchForm.style.top)) offset = parseInt(this.searchForm.style.top);

      if (window.scrollY > offset + this.searchForm.offsetHeight && this.body.classList.contains('sho')) {
        this.closeSearch();
      }
    })
  }

  closeSearch() {
    this.body.classList.remove('sho');
    this.body.classList.remove('shs');
    this.searchForm.style.top = null;
  }

  searchSuggestions(input) {
    this.listener = true;
    input.addEventListener('keyup', (e) => {
      this.inputKeyUp(e);
    });
  }

  inputKeyUp(e) {
    const value = e.target.value;
    const loader = this.searchForm.querySelector('.js-loader') as HTMLElement;
    const results = this.searchForm.querySelector('.js-search-results') as HTMLElement;

    if (value !== '') {

      loader.style.display = 'block';
      results.innerHTML = '';
      results.style.display = 'none';

      this.data = {
        s: e.target.value
      };

      this.http.request('get', {
        action: this.action,
        data: this.data
      }).then((res) => {
        const data: SearchSuggestions = JSON.parse(res.data);
        loader.style.display = 'none';
        results.style.display = null;
        results.innerHTML = data.html;
      }).catch((error) => {
        console.log(error);
      });
    } else {
      loader.style.display = 'none';
      results.style.display = 'none';
      results.innerHTML = '';
    }
  }
}

new Search;
