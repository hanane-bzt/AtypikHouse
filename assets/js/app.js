import '../bootstrap.js';
/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */
import './styles/app.css';

console.log('This log comes from assets/app.js - welcome to AssetMapper! 🎉');

import ReactDOM from 'react-dom';

import React from 'react';
import { createRoot } from 'react-dom/client';

function App() {
    return <h1>Hello, React!</h1>;
}

const rootElement = document.getElementById('root');
const root = createRoot(rootElement);

root.render(<App />);
