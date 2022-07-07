{{--------------- Auth ---------------}}
<input id="inp-route-web-public-login-in" type="hidden" value="{{route("web.public.login.in")}}">

{{--------------- Admin ---------------}}
<input id="inp-route-web-admin-home-graphics" type="hidden" value="{{route("web.admin.home.graphics")}}">

<input id="inp-route-web-admin-users-list" type="hidden" value="{{route("web.admin.users.list")}}">
<input id="inp-route-web-admin-users-view" type="hidden" value="{{route("web.admin.users.view", ['id' => 'FAKE_ID'])}}">
<input id="inp-route-web-admin-users-delete" type="hidden" value="{{route("web.admin.users.delete")}}">
<input id="inp-route-web-admin-users-create" type="hidden" value="{{route("web.admin.users.create")}}">
<input id="inp-route-web-admin-users-edit" type="hidden" value="{{route("web.admin.users.edit")}}">

<input id="inp-route-web-admin-products-list" type="hidden" value="{{route("web.admin.products.list")}}">
<input id="inp-route-web-admin-products-view" type="hidden" value="{{route("web.admin.products.view", ['id' => 'FAKE_ID'])}}">
<input id="inp-route-web-admin-products-delete" type="hidden" value="{{route("web.admin.products.delete")}}">
<input id="inp-route-web-admin-products-create" type="hidden" value="{{route("web.admin.products.create")}}">
<input id="inp-route-web-admin-products-edit" type="hidden" value="{{route("web.admin.products.edit")}}">

<input id="inp-route-web-admin-tables-list" type="hidden" value="{{route("web.admin.tables.list")}}">
<input id="inp-route-web-admin-tables-view" type="hidden" value="{{route("web.admin.tables.view", ['id' => 'FAKE_ID'])}}">
<input id="inp-route-web-admin-tables-delete" type="hidden" value="{{route("web.admin.tables.delete")}}">
<input id="inp-route-web-admin-tables-create" type="hidden" value="{{route("web.admin.tables.create")}}">
<input id="inp-route-web-admin-tables-edit" type="hidden" value="{{route("web.admin.tables.edit")}}">

{{--------------- Manager ---------------}}
<input id="inp-route-web-manager-orders-list" type="hidden" value="{{route("web.manager.orders.list")}}">
<input id="inp-route-web-manager-orders-view" type="hidden" value="{{route("web.manager.orders.view", ['id' => 'FAKE_ID'])}}">
<input id="inp-route-web-manager-orders-delete" type="hidden" value="{{route("web.manager.orders.delete")}}">
<input id="inp-route-web-manager-orders-edit" type="hidden" value="{{route("web.manager.orders.edit")}}">
<input id="inp-route-web-manager-orders-collect" type="hidden" value="{{route("web.manager.orders.collect")}}">

{{--------------- Waiter ---------------}}
<input id="inp-route-web-waiter-orders-list" type="hidden" value="{{route("web.waiter.orders.list")}}">
<input id="inp-route-web-waiter-orders-view" type="hidden" value="{{route("web.waiter.orders.view", ['id' => 'FAKE_ID'])}}">
<input id="inp-route-web-waiter-orders-create" type="hidden" value="{{route("web.waiter.orders.create")}}">
