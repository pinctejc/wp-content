import Sticky from 'sticky-js';

class SidebarSection {

  constructor() {
    window.vars.sticky = new Sticky('.js-sticky-sidebar');
  }
}

new SidebarSection();
