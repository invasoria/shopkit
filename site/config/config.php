<?php

/*

---------------------------------------
License Setup
---------------------------------------

Please add your license key, which you've received
via email after purchasing Kirby on http://getkirby.com/buy

It is not permitted to run a public website without a
valid license key. Please read the End User License Agreement
for more information: http://getkirby.com/license

*/

c::set('license', 'put your kirby license key here');

/*
---------------------------------------
User roles
--------------------------------------

*/

c::set('roles', array(
  array(
    'id'      => 'customer',
    'name'    => 'Customer',
    'default' => true,
    'panel'   => false
  ),
  array(
    'id'      => 'admin',
    'name'    => 'Admin',
    'panel'   => true
  ),
  array(
    'id'      => 'editor',
    'name'    => 'Editor',
    'panel'   => true
  ),
  array(
    'id'      => 'wholesaler',
    'name'    => 'Wholesaler',
    'panel'   => false
  )
));


/*

---------------------------------------
Routes
--------------------------------------

*/

c::set('routes', array(
  array(
    'pattern' => 'logout',
    'action'  => function() {
      if($user = site()->user()) $user->logout();
      return go('login');
    }
  ),
  array(
    'pattern' => 'shop/cart/empty',
    'action' => function() {
      s::start();
      s::set('cart', array()); // Empty the cart
      // Send along a status message
      return go('shop/cart');
    }
  ),
  array(
    'pattern' => 'shop/cart/invoice',
    'method' => 'POST',
    'action' => function() {
      snippet('process-invoice');
      // Send along a success message
      return go('shop/orders');
    }
  ),
  array(
    'pattern' => 'shop/orders/pdf',
    'method' => 'POST',
    'action' => function() {
      snippet('pdf');
      return true;
    }
  ),
  array(
    'pattern' => 'shop/cart/success',
    'method' => 'POST',
    'action' => function() {
      snippet('paypal-success');
      // Send along a success message
      return go('shop/orders');
    }
  )
));