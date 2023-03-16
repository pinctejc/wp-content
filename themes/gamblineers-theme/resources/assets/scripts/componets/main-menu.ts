class MainMenu {
  body: HTMLBodyElement;
  mainMenuClassOpen = 'mmo';
  mainSubMenuClassOpen = 'smo';
  subMenuClassOpen = 'open';
  btnMenu: HTMLButtonElement;
  btnSubMenu: HTMLButtonElement;
  mainMenuList: HTMLUListElement;
  subMenuLinks: HTMLLIElement[] = [];

  constructor() {
    this.body = document.querySelector('body');
    this.btnMenu = document.querySelector('.js-main-menu');
    this.btnSubMenu = document.querySelector('.js-submenu');
    this.mainMenuList = document.querySelector('.primary-nav');
    if (this.mainMenuList) {
      this.subMenuLinks = [].slice.call(this.mainMenuList.querySelectorAll('.menu-item-has-children'));
      this.mainMenu();
      this.mainSubMenu();
      this.openSubMenu();
      this.closeTargetMainMenu();
    }
  }

  mainMenu() {
    this.btnMenu.addEventListener('click', () => {
      if ( !this.body.classList.contains(this.mainMenuClassOpen) ) {
        this.body.classList.add(this.mainMenuClassOpen);
      } else if (this.body.classList.contains(this.mainSubMenuClassOpen)) {
        this.body.classList.remove(this.mainSubMenuClassOpen)
        this.subMenuLinks.forEach((openMenu: HTMLLIElement) => {
          openMenu.classList.remove('open');
        });
      } else {
        this.closeSubMenu();
        this.closeMainMenu();
      }
    });
  }

  mainSubMenu() {
    this.btnSubMenu.addEventListener('click', () => {
      this.closeSubMenu();
      if (!this.body.classList.contains(this.mainSubMenuClassOpen)) {
        this.body.classList.add(this.mainMenuClassOpen);
        this.body.classList.add(this.mainSubMenuClassOpen);
        this.subMenuLinks.map(subMenu => {
          if (subMenu.classList.contains('header-sub-menu')) {
            const first_item = subMenu.querySelector('.sub-menu > li');
            subMenu.classList.add('open');
            first_item.classList.add('active');
          }
        });
      } else {
        this.closeMainMenu();
        this.closeSubMenu();
      }
    });
  }

  closeMainMenu() {
    const openSubMenus = [].slice.call(this.mainMenuList.querySelectorAll('.open'));
    this.body.classList.remove(this.mainMenuClassOpen);
    this.body.classList.remove(this.mainSubMenuClassOpen);
    openSubMenus.forEach((openMenu: HTMLLIElement) => {
      openMenu.classList.remove('open');
    });
  }

  closeSubMenu() {
    const openSubMenus = [].slice.call(this.mainMenuList.querySelectorAll('.active'));
    openSubMenus.forEach((openMenu: HTMLLIElement) => {
      openMenu.classList.remove('open');
      openMenu.classList.remove('active');
    });
  }

  openSubMenu() {

    this.subMenuLinks.forEach(link => {
      link.addEventListener('click', (e) => {
        if (window.innerWidth < 992) {
          const li = e.target as HTMLLIElement;
          if (li.tagName === 'LI' && link === li) {
            li.classList.toggle(this.subMenuClassOpen);
            this.closeSubMenu();
            if (this.body.classList.contains(this.mainSubMenuClassOpen)) {
              this.closeMainMenu();
            }
            if (li.classList.contains('header-sub-menu')) {
              const first_item = li.querySelector('.sub-menu > li');
              first_item.classList.add('active');
            }
          } else if (li.tagName === 'A') {
            if (li.nextSibling) {
              if (!li.parentElement.classList.contains('active')) {
                e.preventDefault();
                this.closeSubMenu();
                li.parentElement.classList.add('active');
              }
            } else {
              this.closeSubMenu();
            }
          }
        }
      });
    });
  }

  closeTargetMainMenu() {
    document.addEventListener('click', (e) => {
      const target = e.target as HTMLElement;
      if (!target.classList.contains('primary-nav') && !target.closest('.primary-nav') && !target.closest('.js-main-menu') && !target.closest('.js-submenu') && !target.closest('.sf')) {
        this.closeMainMenu();
        this.closeSubMenu();
      }
    });
  }
}

new MainMenu;
