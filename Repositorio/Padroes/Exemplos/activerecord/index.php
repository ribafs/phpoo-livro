<?php
include_once 'ActiveRecord.php';
include_once 'Connection.php';
include_once 'Customers.php';

Customers::setConnection(Connection::getInstance('./configdb.ini'));
/*
$customer = new Customer();
$customer->name = 'Ana Angélica';
$customer->birthday = '1970-01-21';
$customer->phone = '3491.2786';
$customer->observation = 'Obs2';

$customer = new Customer();
$customer->name = 'Fátima Evangelista';
$customer->id=25;

$todos = Customer::all();
print '<table>';
foreach($todos as $customer){
    print '<tr><td>'.$customer->id.'</td><td>'.$customer->name.'</td><td>'.$customer->birthday.'</td></tr>';
}
print '</table>';

$customer = Customer::findFisrt("name = 'Austin S. Wall'");

foreach($customer as $c){
    print $c->phone;
} 
*/
$customer = Customers::find(2);
print $customer->name.'-'.$customer->birthday.'-'.$customer->email;

/*
if ($customer->save()) {
    echo "Registro atualizado!";
} else {
    echo "Registro <b>NÃO FOI</b> atualizado!";
}
*/
//echo Customer::numTotal();
