class Cookie {
  cookieWidget: HTMLDivElement;
  cookieBtn: HTMLButtonElement;

  constructor() {
    this.cookieWidget = document.querySelector('.cookie');
    this.cookieBtn = document.querySelector('.cookie__btn');
    this.setCookie();
  }

  setCookie() {
    if (this.cookieBtn) {
      this.cookieBtn.addEventListener('click', () => {
        this.createCookie('wordpress_theme_cookie', 'true', 14)
        this.cookieWidget.remove();
      });
    }
  }

  createCookie(name, value, days) {
    if (days) {
      var date = new Date();
      date.setTime(date.getTime()+(days*24*60*60*1000));
      var expires = "; expires="+ date.toString();
    }
    else var expires = "";
    document.cookie = name+"="+value+expires+"; path=/; domain=" + window.location.hostname;
  }
}

new Cookie();
