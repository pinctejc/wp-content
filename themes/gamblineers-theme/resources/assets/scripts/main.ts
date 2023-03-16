import Button from "./componets/_button";
import { scrollToElement } from "./componets/_scrollto";

class Main {
  body = document.querySelector('body');
  header: HTMLElement;
  defer: NodeList;
  button: Button;
  scrollTop: HTMLLinkElement;

  constructor() {
    this.button = new Button();
    this.defer = document.querySelectorAll('.js-defer-html');
    this.header = document.querySelector('.header');
    this.scrollTop = document.querySelector('.scroll-top');
    this.deferHTML();
    this.button.state('.js-state');
    this.anchorsScroll();
    this.anchorsScroll('a');
  }

  deferHTML() {
    this.defer.forEach((html: HTMLElement) => {
      html.childNodes.forEach((item: HTMLElement) => {
        if (item.nodeType === 8) {
          html.innerHTML = item.nodeValue;
        } else {
          html.classList.remove('d-n');
        }
      });
    });
  }

  anchorsScroll(selector = '.js-anchor') {
    const anchors = document.querySelectorAll(selector);
    anchors.forEach(anchor =>
      anchor.addEventListener('click', (e) => {
        let href = (anchor as HTMLLinkElement).getAttribute('href');
        if (href.startsWith('#') || href.includes('#')) {
          href = href.substring(href.indexOf('#'));
          const element = document.querySelector(href) as HTMLElement;
          if (element) {
            e.preventDefault();
            const offset = this.header.clientHeight + 10;
            this.body.classList.remove('menu-opened');
            scrollToElement(href, offset);
            const interval = setInterval(() => {
              if (element.offsetTop - this.header.clientHeight >= window.scrollY - 5 && element.offsetTop - this.header.clientHeight <= window.scrollY + 5 || window.scrollY + window.outerHeight >= document.body.scrollHeight) {
                clearInterval(interval);
              }
              scrollToElement(href, offset);
            }, 821);
          }
        }
      })
    );
  }

  onScroll() {
    window.addEventListener('scroll', () => {
      if (this.scrollTop) {
        if (window.scrollY > 700) {
          this.scrollTop.classList.remove('d-n');
        } else {
          this.scrollTop.classList.add('d-n');
        }
      }
    })
  }

}

new Main;
