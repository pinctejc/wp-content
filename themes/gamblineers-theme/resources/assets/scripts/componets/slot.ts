
class Slot {
  demoPlayBtn: HTMLButtonElement;
  slotFeaturedImage: HTMLDivElement;
  slotIframeHolder: HTMLDivElement;
  slotIframe: HTMLIFrameElement;
  
  constructor() {
    this.demoPlayBtn = document.querySelector('.js-demo-play');
    this.demoPLay();
  }


  demoPLay() {
    if (this.demoPlayBtn) {
      this.slotFeaturedImage = document.querySelector('.sh__fi');
      this.slotIframeHolder = document.querySelector('.sh__iframe');
      this.slotIframe = this.slotIframeHolder.querySelector('iframe');

      this.demoPlayBtn.addEventListener('click', () => {
        this.slotFeaturedImage.classList.add('d-n');
        this.slotIframeHolder.classList.remove('d-n');
        this.slotIframe.src = this.slotIframe.dataset.src;
      });
    }
  }
}

new Slot();