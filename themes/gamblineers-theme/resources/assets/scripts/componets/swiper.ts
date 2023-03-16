import { Swiper } from 'swiper';

class Sliders {
  casinosSliders: Swiper[] = [];
  newsSliders: Swiper[] = [];

  constructor() {
    this.casinosSlider();
    this.newsSlider();
  }

  casinosSlider () {
    const casinosSliders = [].slice.call(document.querySelectorAll('.js-casinos-slider'));
    casinosSliders.forEach((slider: HTMLDivElement) => {
      this.casinosSliders.push(
        new Swiper(slider, {
          slidesPerView: 'auto',
          freeMode: true,
          simulateTouch: false
        })
      );
    });
  }

  newsSlider () {
    const newsSliders = [].slice.call(document.querySelectorAll('.js-news-slider'));
    newsSliders.forEach((slider: HTMLDivElement) => {
      this.newsSliders.push(
        new Swiper(slider, {
          slidesPerView: 'auto',
          freeMode: true,
          simulateTouch: false
        })
      );
    });
  }
}

new Sliders;
