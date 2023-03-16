import { IArgsConfig, ICasinoModule, INewsModule, ISlotModule } from "./_interface-query-args";

export interface IListCasinoDatas {
  view: string,
  slider: string,
  page_posts: number,
  total_posts: number,
  args: IArgsConfig,
  ordered: boolean,
  module?: ICasinoModule
  bonus_type?: string,
}

export interface IListNewsDatas {
  page_posts: number,
  total_posts: number,
  view: string,
  args: IArgsConfig,
  module?: INewsModule
}

export interface IListSlotsDatas {
  page_posts: number,
  total_posts: number,
  args: IArgsConfig,
  module?: ISlotModule
}

export interface IListGamesDatas {
  page_posts: number,
  total_posts: number,
  found_posts: number,
  view: string,
  args: IArgsConfig
}

export interface IListProvidersDatas {
  page_posts: number,
  total_posts: number,
  found_posts: number,
  view: string,
  args: IArgsConfig
}

export interface IListPaymentsDatas {
  page_posts: number,
  total_posts: number,
  found_posts: number,
  view: string,
  args: IArgsConfig
}

export interface IListLicensesDatas {
  page_posts: number,
  total_posts: number,
  found_posts: number,
  view: string,
  args: IArgsConfig
}

export interface ISearchSuggestions {
  s: string;
}
