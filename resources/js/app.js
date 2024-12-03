import './bootstrap';

import Alpine from 'alpinejs';
window.Alpine = Alpine;

Alpine.start();

import { Buffer } from 'buffer';

// Now you can use Buffer in your code
const buf = Buffer.from('Hello, world!', 'utf-8');

window.Buffer = Buffer; // Ensure Buffer is globally accessible
console.log('Buffer is defined:', typeof Buffer !== 'undefined');
console.log('Buffer.from is a function:', typeof Buffer.from === 'function');
