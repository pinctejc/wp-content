import Button from "../componets/_button";

class FAQ {
  button: Button;
  questions: HTMLElement[] = [];

  constructor() {
    this.button = new Button();
    this.button.state('.faq__q');
    this.questions = [].slice.call(document.querySelectorAll('.faq__q'));

    if (this.questions.length) this.faqCollapse();
  }

  faqCollapse() {
    this.questions.map(question => {
      question.addEventListener('click', () => {
        const answer = question.nextElementSibling as HTMLElement;
        if (answer.closest('.faq').classList.contains('active')) {
          answer.style.height = answer.scrollHeight + 'px';
        } else {
          answer.style.height = null;
        }
      })
    })
  }
}

new FAQ;
