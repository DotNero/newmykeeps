import Reac, {Compontnet} from 'react';
import {
    BrowserRouter as Router,
    Switch,
    Route, 
    Link,
} from 'react-router-dom';

function Navbar(){
    return(
        <Router>
            <nav className = "navbar">

            <ul>
                <li><a href="#">Главная</a></li>
                <li><a href="#">Новости</a></li>
                <li><a href="#">Контакты</a></li>
                <li><a href="#">О нас</a></li>
            </ul>

            </nav>


        </Router>
    )
}

export default Navbar;
