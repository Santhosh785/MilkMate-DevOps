import React from 'react';
import AavinLogo from './Images/AavinLogo.png';
import './Header.css';


const _Header = () => {
    return (
        <header className=''>
            <img src={AavinLogo} alt="MilkMate Logo" style={{ width: 100 }} />

            <div class="button-container">
                <button class="button">Hi...</button>
                <button class="button">Logout</button>
            </div>



        </header>
    );
};

export default _Header;
