import { scrollToElement } from "./_scrollto";

interface ITitle {
  tag: string;
  text: string;
}

class TableOfContents {
  body       : HTMLBodyElement;
  header     : HTMLElement;
  logo       : HTMLElement;
  toc        : HTMLDivElement;
  pageTitles : HTMLTitleElement[] = [];
  titles     : ITitle[] = [];
  loaded     : boolean;


  constructor() {
    this.init();
  }

  init(): void {
    this.loaded     = false;
    this.body       = document.querySelector('body');
    this.header     = document.querySelector('.header');
    this.logo       = document.querySelector('.header__logo');
    this.toc        = document.querySelector('.toc');
    this.pageTitles = [].slice.call(document.querySelectorAll('.title h1, .title h2, .title h3, .ts h1, .ts h2, .ts h3'));

    if (this.pageTitles.length) {
      this.toc.classList.remove('d-n');
      this.logo.classList.add('ml-o-xs-25', 'pl-o-xs-20');
      this.setTOC();
      this.tocToggleShow();
    }
  }

  setTOC() {
    let html = `<ul class="toc__list pb-10 bg-pv fs-12 fw-m tc-w of-a">`;

    this.pageTitles.map((title, i: number) => {
      title.id = 'toc-' + (i + 1);
      html += `<li><a href="#toc-`+ (i + 1) + `" class="d-b py-10 pr-10 tc-w tc-h-w js-toc `+ (title.tagName === 'H3' ? 'pl-40' : 'pl-20') + `">`+ title.textContent +`</a></li>`;
    });

    html += `</ul>`;

    this.toc.insertAdjacentHTML('beforeend', html);
    this.tocScroll();
  }

  tocScroll(selector = '.js-toc') {
    const anchors = document.querySelectorAll(selector);

    anchors.forEach(anchor =>
      anchor.addEventListener('click', (e) => {
        const href = (anchor as HTMLLinkElement).getAttribute('href');
        const element = document.querySelector(href) as HTMLElement;
        const offset = this.header.clientHeight + 10;
        if (element) {
          e.preventDefault();
          scrollToElement(href, offset);
          const interval = setInterval(() => {
            if (element.offsetTop - this.header.clientHeight >= window.scrollY - 3 && element.offsetTop - this.header.clientHeight <= window.scrollY + 3 || window.scrollY + window.outerHeight >= document.body.scrollHeight ) {
              clearInterval(interval);
            }
            scrollToElement(href, offset);
          }, 821);
        }
      })
    );
  }

  tocToggleShow() {
    document.addEventListener('click', (e) => {
      const target = e.target as HTMLElement;
      if ( target.classList.contains('.js-toc-btn') || target.closest('.js-toc-btn')) {
        this.toc.classList.add('open');
        this.body.classList.add('of-h');
      } else {
        this.toc.classList.remove('open');
        this.body.classList.remove('of-h');
      }
    });
  }
}

new TableOfContents();
