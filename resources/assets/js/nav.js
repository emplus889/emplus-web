export default {
  items: [
    {
      name: 'Dashboard',
      url: '/user',
      icon: 'icon-speedometer',
    },
    {
      title: true,
      name: 'Wallet',
      class: '',
      wrapper: {
        element: '',
        attributes: {}
      }
    },
    {
      name: 'My Wallet',
      url: '/user/wallet',
      icon: 'icon-wallet'
    },
    {
      name: 'Transfer',
      url: '/user/transfer',
      icon: 'fa fa-exchange'
    },
    {
      name: 'Promo',
      url: '/user/promo',
      icon: 'fa fa-star'
    },
    {
      title: true,
      name: 'Settings'
    },
    {
      name: 'Account',
      url: '/user/account',
      icon: 'fa fa-user'
    },
    {
      name: 'Application',
      url: '/user/application',
      icon: 'fa fa-cogs'
    },
  ]
}
