import { scrollToElement } from './_scrollto';

class ModuleSettings {
  header             : HTMLElement;
  backgrounds        : NodeList;
  textExpands        : NodeList;
  btnsTextExpands    : NodeList;
  textExpandsHeights : number[] = [];
  textExpanded       : boolean[] = [];

  constructor() {
    this.header          = document.querySelector('.header');
    this.backgrounds     = document.querySelectorAll('[data-bg_desktop], [data-bg_mobile]');
    this.textExpands     = document.querySelectorAll('[data-limit_desktop], [data-limit_mobile]');
    this.btnsTextExpands = document.querySelectorAll('.js-text-expand');
    this.setChanges();
    this.toggleTextExpands();
    this.autoScrollAnchor();
    window.addEventListener('resize', this.setChanges);
  }

  setChanges = () => {
    this.setBackground();
    this.TextExpands();
  }

  setBackground = () => {
    if (this.backgrounds) {
      this.backgrounds.forEach((item: HTMLElement) => {
        if (window.innerWidth > 767 && item.dataset.bg_desktop) {
          if (item.dataset.bg_desktop.includes('url')) {
            item.style.backgroundImage = item.dataset.bg_desktop;
            item.style.backgroundPosition = item.dataset.bg_pos_desktop;
            item.style.backgroundRepeat = 'no-repeat';
          }
          else {
            item.style.backgroundColor = item.dataset.bg_desktop
          }
        } else if (window.innerWidth <= 767 && item.dataset.bg_mobile) {
          if (item.dataset.bg_desktop.includes('url')) {
            item.style.backgroundImage = item.dataset.bg_mobile
            item.style.backgroundPosition = item.dataset.bg_pos_mobile;
            item.style.backgroundRepeat = 'no-repeat';
          }
          else {
            item.style.backgroundColor = item.dataset.bg_mobile
          }
        } else if (item.style.backgroundImage) {
          item.style.background = null;
        }
      });
    }
  }

  TextExpands = () => {
    if (this.textExpands) {
      this.textExpands.forEach((item: HTMLElement, i) => {
        if (!item.classList.contains('active')) {
          const height = item.offsetHeight;
          item.style.height = null;

          const heightFull = item.offsetHeight;
          item.style.height = height + 'px';
          this.textExpandsHeights[i] = heightFull;

          this.setTextExpands(item);
        }
      });
    }
  }

  setTextExpands = (item: HTMLElement) => {
    if (window.innerWidth > 767 && item.dataset.limit_desktop) {
      item.style.height = item.dataset.limit_desktop + 'px';
    } else if (window.innerWidth <= 767 && item.dataset.limit_mobile) {
      item.style.height = item.dataset.limit_mobile  + 'px';
    } else {
      item.style.height = null;
    }
  }

  toggleTextExpands = () => {
    if (this.btnsTextExpands) {
      this.btnsTextExpands.forEach((item: HTMLButtonElement, i) => {
        this.textExpanded[i] = false;
        item.addEventListener('click', () => {
          const textExpand = this.textExpands[i] as HTMLElement;

          if (this.textExpanded[i]) {
            this.setTextExpands(textExpand);
          } else {
            textExpand.style.height = this.textExpandsHeights[i] + 'px';
          }

          (this.textExpands[i] as HTMLElement).classList.toggle('active');
          item.classList.toggle('active');
          this.textExpanded[i] = !this.textExpanded[i];
        })
      });
    }
  }

  autoScrollAnchor = () => {
    const hash = window.location.hash;
    if (hash) {
      const offset = this.header.clientHeight + 10;
      const element = document.querySelector(hash) as HTMLElement;
      if (element) {
        scrollToElement(hash, offset);
        const interval = setInterval(() => {
          if (element.offsetTop - this.header.clientHeight >= window.scrollY - 5 && element.offsetTop - this.header.clientHeight <= window.scrollY + 5 || window.scrollY + window.outerHeight >= document.body.scrollHeight ) {
            clearInterval(interval);
          }
          scrollToElement(hash, offset);
        }, 821);
      }
    }
  }
}

new ModuleSettings;
