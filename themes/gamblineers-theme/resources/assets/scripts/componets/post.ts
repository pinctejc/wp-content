 import 'fslightbox';

class Post {
  casinoHeader   : HTMLElement;
  btnShowRatings : HTMLButtonElement;
  headerRatings  : HTMLDivElement;
  overview       : HTMLDivElement;
  overviewBtn    : HTMLButtonElement;
  stickyBottom   : HTMLDivElement;
  commentForm    : HTMLFormElement;
  isShowRatings  = false;

  constructor() {
    this.casinoHeader   = document.querySelector('.ch');
    this.btnShowRatings = document.querySelector('.js-show-ratings');
    this.headerRatings  = document.querySelector('.ch__ratings');
    this.overview       = document.querySelector('.co');
    this.overviewBtn    = document.querySelector('.co__more');
    this.stickyBottom   = document.querySelector('.cs');
    this.commentForm    = document.querySelector('#commentform');


    this.onToggleRatings();
    this.onOverviewRead();
    this.casinoStickyBottom();
    this.commentFormValidate();

    window.addEventListener('scroll', () => {
      this.onOverviewRead();
      this.casinoStickyBottom();
    });

    window.addEventListener('resize', () => {
      this.onOverviewRead();
      this.casinoStickyBottom();
    });
  }

  onOverviewRead() {
    if (window.innerWidth < 768 && this.overview && this.overview.scrollHeight > 300) {
      this.overviewBtn.classList.remove('d-n');
    } else {
      this.overviewBtn.classList.add('d-n');
    }
  }

  onToggleRatings() {
    if (this.btnShowRatings) {
      this.btnShowRatings.addEventListener('click', () => {
        if (this.isShowRatings) {
          this.headerRatings.style.height = null;
        } else {
          this.headerRatings.style.height = this.headerRatings.scrollHeight + 'px';
        }

        this.isShowRatings = !this.isShowRatings;

        if (window.vars.sticky) {
          setTimeout(() => {
            window.vars.sticky.update();
          }, 501);
        }
      });
    }
  }

  casinoStickyBottom() {
    const headerRect = this.casinoHeader.getBoundingClientRect();
    if (window.screenTop > headerRect.bottom - 52) {
      this.stickyBottom.classList.add('shown');
    } else {
      this.stickyBottom.classList.remove('shown');
    }
  }

  commentFormValidate() {
    if (this.commentForm) {
      const form_elements = [
        'rating',
        'author',
        'email',
        'comment'
      ];

      this.commentForm.addEventListener('submit', (e) => {
        const rating = this.commentForm.querySelector('[name="rating"]:checked');
        const error = this.commentForm.querySelector('.comment-form-error-message');
        let error_message = 'One or more fields have an error. Please check and try again.';
        let submit = true;

        if (error) {
          error.remove();
        }

        if ( !rating ) {
          submit = false;
          error_message = 'Please select your rating and try again.';
        }

        form_elements.forEach(id => {
          const form_control = document.getElementById(id) as HTMLInputElement | HTMLTextAreaElement;
          if (form_control) {
            form_control.classList.remove('comment-error');
            if (form_control.value === '') {
              submit = false;
              form_control.classList.add('comment-error');
            } else if (form_control.type === 'email') {
              var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
              if (!re.test(form_control.value)) {
                submit = false;
                form_control.classList.add('comment-error');
              }
            }
          }
        });

        if (!submit) {
          this.commentForm.insertAdjacentHTML('beforeend', `<p class="comment-form-error-message">${error_message}</p>`);
          e.preventDefault();
        }
      });
    }
  }
}

new Post();
