interface IMetaQuery {
  relation?: string;
  key: string;
  value: string | string[] | number[];
  compare?: string;
}

interface IMinMax {
  min?: number,
  max?: number,
}

export interface ICasinoModule {
  post_type: 'post',
  post_status: 'publish',
  list_type: '1' | '2' | '3',
  offset: number,
  bonus_amount?: IMinMax,
  free_spins?: IMinMax,
  minimum_deposit?: IMinMax,
  minimum_bet?: IMinMax,
  maximum_bet?: IMinMax,
  wagering_requirements?: IMinMax,
  software_providers?: string | string[],
  deposit_methods?: string | string[],
  licenses?: string | string[],
  languages?: string | string[],
  game_types?: string | string[],
  support_languages?: string | string[],
  number_of_results: number,
  results_per_page: number,
  casinos?: string[],
  order_by?: string,
  order_by_manually?: string,
  show_disable?: boolean,
  meta_query?: IMetaQuery[]
}

export interface ISlotModule {
  post_type: 'slot',
  post_status: 'publish',
  list_type: '1' | '2' | '3',
  offset: number,
  software_providers?: string | string[],
  slot_type?: string | string[],
  volatility?: string | string[],
  name?: string,
  number_of_results: number,
  results_per_page: number,
  slots?: string[],
  order_by?: string,
}

export interface INewsModule {
  post_type: 'news';
  post_status: 'publish';
  list_type: '1' | '2' | '3',
  offset?: number;
  paged?: number;
  post__in?: string[] | number[];
  order_by?: string;
  order?: string;
  number_of_results: number,
  results_per_page: number;
  categories?: string | number | string[] | number[];
}

export interface IArgsConfig {
  post_type?: string;
  taxonomy?: string;
  post_status?: string;
  offset?: number;
  paged?: number;
  post__in?: string[] | number[];
  include?: string[] | string[];
  orderby?: string;
  order?: string;
  meta_value_num?: string | number;
  meta_query?: IMetaQuery[];
  posts_per_page?: number;
  number?: number;
}
