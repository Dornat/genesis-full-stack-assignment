import React from 'react';
import {BrowserRouter, Route, Switch} from 'react-router-dom';
import Home from './Home';
import Astrologer from './Astrologer';

const App = () => {
    return (
        <BrowserRouter>
            <Switch>
                <Route exact path="/" component={Home}/>
                <Route exact path="/astrologer/:id" component={Astrologer}/>
            </Switch>
        </BrowserRouter>
    );
};

export default App;
