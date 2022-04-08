import { AuthenticationService } from './../../../../services/authentication.service';
import {Injectable} from '@angular/core';

export interface NavigationItem {
  id: string;
  title: string;
  type: 'item' | 'collapse' | 'group';
  translate?: string;
  icon?: string;
  hidden?: boolean;
  url?: string;
  classes?: string;
  exactMatch?: boolean;
  external?: boolean;
  target?: boolean;
  breadcrumbs?: boolean;
  function?: any;
  badge?: {
    title?: string;
    type?: string;
  };
  children?: Navigation[];
}

export interface Navigation extends NavigationItem {
  children?: NavigationItem[];
}
const NavigationItems = [
  {
    id: 'home',
    title: 'Home',
    type: 'group',
    role: [1,2],
    icon: 'feather icon-monitor',
    children: [
      {
        id: 'dashboard',
        title: 'Dashboard',
        type: 'item',
        url: '/authenticated/dashboard/analytics',
        icon: 'feather icon-home'
      }
    ]
  },
  {
    id: 'account',
    title: 'Account',
    type: 'group',
    role: [1],
    icon: 'feather icon-align-left',
    children: [
      {
        id: 'Account',
        title: 'Account',
        type: 'collapse',
        icon: 'feather icon-menu',
        children: [
          {
            id: 'Profile',
            title: 'Profile',
            type: 'item',
            url: '/authenticated/account/profile',
            external: false
          },
          {
            id: 'BTC_Account',
            title: 'BTC Account',
            type: 'item',
            url: '/authenticated/account/btc',
            external: false
          },
          {
            id: 'ETH_Account',
            title: 'ETH Account',
            type: 'item',
            url: '/authenticated/account/eth',
            external: false
          },
          {
            id: 'USDT_Account',
            title: 'USDT Account',
            type: 'item',
            url: '/authenticated/account/usdt',
            external: false
          }
        ]
      }
    ]
  },
  {
    id: 'account',
    title: 'Account',
    type: 'group',
    role: [2],
    icon: 'feather icon-align-left',
    children: [
      {
        id: 'Account',
        title: 'Account',
        type: 'collapse',
        icon: 'feather icon-menu',
        children: [
          {
            id: 'Profile',
            title: 'Profile',
            type: 'item',
            url: '/authenticated/account/profile',
            external: false
          }
        ]
      }
    ]
  },
  {
    id: 'plan',
    title: 'Plan',
    type: 'group',
    role: [1],
    icon: 'feather icon-align-left',
    children: [
      {
        id: 'Plan',
        title: 'Plan',
        type: 'collapse',
        icon: 'feather icon-activity',
        children: [
          {
            id: 'make_plan',
            title: 'Create Plan',
            type: 'item',
            url: '/authenticated/plan/create',
            external: false
          },
          {
            id: 'plan_record',
            title: 'Plan Record',
            type: 'item',
            url: '/authenticated/plan/record',
            external: false
          }
        ]
      }
    ]
  },
  {
    id: 'investment',
    title: 'Invest',
    type: 'group',
    role: [2],
    icon: 'feather icon-align-left',
    children: [
      {
        id: 'Invest',
        title: 'Invest',
        type: 'collapse',
        icon: 'feather icon-briefcase',
        children: [
          {
            id: 'invest',
            title: 'Invest',
            type: 'item',
            url: '/authenticated/investment/invest',
            external: false
          },
          {
            id: 'investment_plans',
            title: 'Investment Plans',
            type: 'item',
            url: '/authenticated/investment/plans',
            external: false
          },
          {
            id: 'my_investment',
            title: 'Investment History',
            type: 'item',
            url: '/authenticated/investment/history',
            external: false
          }
        ]
      }
    ]
  },
  {
    id: 'withdrawal',
    title: 'Withdrawal',
    type: 'group',
    role: [2],
    icon: 'feather icon-align-left',
    children: [
      {
        id: 'Withdrawal',
        title: 'Withdrawal',
        type: 'collapse',
        icon: 'feather icon-activity',
        children: [
          {
            id: 'Request_withdrawal',
            title: 'Request withdrawal',
            type: 'item',
            url: '/authenticated/withdrawal/request',
            external: false
          },
          {
            id: 'My_Withdrawals',
            title: 'Withdrawal History',
            type: 'item',
            url: '/authenticated/withdrawal/history',
            external: false
          }
        ]
      }
    ]
  },
  {
    id: 'user',
    title: 'User Management',
    type: 'group',
    role: [1],
    icon: 'feather icon-user',
    children: [
      {
        id: 'Users',
        title: 'Users',
        type: 'collapse',
        icon: 'feather icon-user',
        children: [
          {
            id: 'List_of_users',
            title: 'Users List',
            type: 'item',
            url: '/authenticated/users/list',
            external: false
          },
          {
            id: 'List_of_investors',
            title: 'Investors List',
            type: 'item',
            url: '/authenticated/users/investors',
            external: false
          }
        ]
      }
    ]
  },
  {
    id: 'Mail',
    title: 'Mail',
    type: 'group',
    role: [1],
    icon: 'feather icon-align-left',
    children: [
      {
        id: 'Mail',
        title: 'Mail',
        type: 'collapse',
        icon: 'feather icon-mail',
        children: [
          {
            id: 'mail',
            title: 'Mail Templates',
            type: 'item',
            url: '/authenticated/mail',
            external: false
          }
        ]
      }
    ]
  },
  {
    id: 'investment',
    title: 'Invest',
    type: 'group',
    role: [1],
    icon: 'feather icon-align-left',
    children: [
      {
        id: 'Invest',
        title: 'Invest',
        type: 'collapse',
        icon: 'feather icon-briefcase',
        children: [
          {
            id: 'invest',
            title: 'Invest requests',
            type: 'item',
            url: '/authenticated/investment/requests',
            // icon: 'feather icon-home',
            external: false
          },
          {
            id: 'Investment_history',
            title: 'Investment History',
            type: 'item',
            url: '/authenticated/investment/history/all',
            // icon: 'feather icon-home',
            external: false
          }
        ]
      }
    ]
  },
  {
    id: 'withdrawal',
    title: 'Withdrawal',
    type: 'group',
    role: [1],
    icon: 'feather icon-activity',
    children: [
      {
        id: 'Withdrawal',
        title: 'Withdrawal',
        type: 'collapse',
        icon: 'feather icon-activity',
        children: [
          {
            id: 'Request_withdrawal',
            title: 'Withdrawal requests',
            type: 'item',
            url: '/authenticated/withdrawal/requests',
            external: false
          },
          {
            id: 'Withdrawal_history',
            title: 'Withdrawals History',
            type: 'item',
            url: '/authenticated/withdrawal/history/all',
            external: false
          }
        ]
      }
    ]
  }
];
@Injectable()
export class NavigationItem {
  public get() {
    return NavigationItems;
  }
}
