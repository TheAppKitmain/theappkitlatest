(function() {
  'use strict';

  var elements = stripe.elements({
    fonts: [
      {
        cssSrc: 'https://fonts.googleapis.com/css?family=Roboto',
      },
    ],
    // Stripe's examples are localized to specific languages, but if
    // you wish to have Elements automatically detect your user's locale,
    // use `locale: 'auto'` instead.
    locale: window.__exampleLocale
  });

  var card = elements.create('card', {
    iconStyle: 'solid',
    style: {
      base: {
        iconColor: '#000',
        color: '#000',
        fontWeight: 500,
        fontFamily: 'Roboto, Open Sans, Segoe UI, sans-serif',
        fontSize: '13px',
        fontSmoothing: 'antialiased',

        ':-webkit-autofill': {
          color: '#000',
        },
        '::placeholder': {
          color: '#000',
        },
      },
      invalid: {
        iconColor: '#000',
        color: '#000',
      },
    },
  });
  card.mount('#example1-card');

  registerElements([card], 'example1');
})();
