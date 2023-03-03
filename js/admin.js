"use strict";
let area = false;

let contentUsers = document.querySelector('.main__users');
let contentBooks = document.querySelector('.main__books');
let contentOrders = document.querySelector('.main__orders');
let contentDefault = document.querySelector('.main__default');

contentUsers.style.display = "none";
contentBooks.style.display = "none";
contentOrders.style.display = "none";
contentDefault.style.display = "initial";

let users = document.querySelector('#area1');
let books = document.querySelector('#area2');
let orders = document.querySelector('#area3');

users.addEventListener('click', function () {
   area = 'users';
   contentUsers.style.display = "initial";
   contentBooks.style.display = "none";
   contentOrders.style.display = "none";
   contentDefault.style.display = "none";
})

books.addEventListener('click', function () {
   area = 'books';
   contentUsers.style.display = "none";
   contentBooks.style.display = "initial";
   contentOrders.style.display = "none";
   contentDefault.style.display = "none";
})

orders.addEventListener('click', function () {
   area = 'orders';
   contentUsers.style.display = "none";
   contentBooks.style.display = "none";
   contentOrders.style.display = "initial";
   contentDefault.style.display = "none";
})

// if (area === 'users') {
//    contentUsers.style.display = "initial";
// } else {
//    contentUsers.style.display = "none";
// }


// if (area === 'books') {
//    contentBooks.style.display = "initial";
// } else {

// }

// if (area === 'orders') {
//    contentOrders.style.display = "initial";
// } else {

// }
// console.log(users);
// .style.display = "none";
// document.getElementById(id).style.display = "initial";
// users.addEventListener('click', function () {
//    area = 'users';
// })