# IikoTransport
Библиотека для работы с IikoTransport 

## Install 

## Get Started
```php
use IikoTransport\Service\Client;

$client = new Client('api key'); 
```


## Organization 

### Returns organizations available to api-login user. 
```php
use IikoTransport\Request\Organizations;

$request = new Organizations();
$response = $oClient->request($request);
$organizations = $response->getOrganizations();

foreach ($organizations as $organization) {
	var_dump($organization);
}
```

### Returns organizations with additional info
```php
use IikoTransport\Request\Organizations;

$request = new Organizations();
$request->setReturnAdditionalInfo(true);	// <--- set returnAdditionalInfo
$response = $oClient->request($request);
$organizations = $response->getOrganizations();

foreach ($organizations as $organization) {
	var_dump($organization);
}
```


## Terminal groups

### Method that returns information on groups of delivery terminals.
```php
use IikoTransport\Request\Organizations;
use IikoTransport\Request\TerminalGroups;

// +++ collect organizations
$request = new Organizations();
$response = $oClient->request($request);
$organizations = $response->getOrganizations();

$organizationIds = [];
foreach ($organizations as $organization) {
	$organizationIds[] = $organization->id;
}
// --- collect organizations

// +++ collect terminal groups
$request = new TerminalGroups();
$request->setOrganizationIds($organizationIds)
$response = $oClient->request($request);
$terminalGroups = $response->getTerminalGroups();

foreach ($terminalGroups as $terminalGroup) {
	var_dump($terminalGroup);
}
// --- collect terminal groups
```

### Method that returns information on availability of group of terminals.
```php
use IikoTransport\Request\Organizations;
use IikoTransport\Request\TerminalGroups;
use IikoTransport\Request\TerminalGroups\IsAlive;

// +++ collect organizations
$request = new Organizations();
$response = $oClient->request($request);
$organizations = $response->getOrganizations();

$organizationIds = [];
foreach ($organizations as $organization) {
	$organizationIds[] = $organization->id;
}
// --- collect organizations

// +++ collect terminal groups
$request = new TerminalGroups();
$request->setOrganizationIds($organizationIds)
$response = $oClient->request($request);
$terminalGroups = $response->getTerminalGroups();

$terminalGroupIds = [];
foreach ($terminalGroups as $terminalGroup) {
	$terminalGroupIds[] = $terminalGroup->id;
}
// --- collect terminal groups

// +++ collect is alive
$request = new IsAlive($organizationIds, $terminalGroupIds);
$response = $oClient->request($request);
$isAliveStatuses = $response->getIsAliveStatuses();
foreach ($isAliveStatuses as $isAliveStatuse) {
	var_dump($isAliveStatuse);
}
// --- collect is alive
```
