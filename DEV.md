The plan
========

H2. Routing

Bundle
    has embeddable router with root location (route base)
    has set of controllers

Router
    is a set of url templates paired with actions
    has switch of implicit routing conditions - calling controllers
    has redirect
    has create url based on current url, and route base
    
Action
    command with set of arguments
    
Request
    automatic
    manual for tests
    
Controller
    set of actions (or commands)
    can use request
    invoked in Router implicitly
    
View
    uses Router::url() for making urls
    
    
    
H2. Commands

`app [command] [[options] [argument(s)]]*
`git commit ./myfile -m "message" -v`
`shop-cli list-orders

Command
    options
    arguments
    has definition
    fits controller action
    
Argument
    is an unnamed option, can be accessed by position number
    
Option
    name (short name)
    type
    can be stacked (-user-id 123 456 789)
    description
    
    
CliRouter
    setups command based on command line
    
WebRouter
    setups command based on http request
    
ApiRouter
    setups command based on api request
    
