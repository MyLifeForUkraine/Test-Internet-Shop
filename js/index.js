"use strict"
let items = document.querySelectorAll('.item-bestsellers__body,  .item-catalog__body');
console.log(items);
let maxHeightItem = 200;
let maxWidthItem = 200;
// let itemsHeight = [];
for (let i = 0; i < items.length; i++) {
   // console.log('items[i].clientHeight: ', items[i].clientHeight);
   // console.log('items[i].clientWidth: ', items[i].clientWidth);
   // itemsHeight.push(items[i].clientHeight);
   if (maxHeightItem < items[i].clientHeight) {
      maxHeightItem = items[i].clientHeight;
   }
   if (maxWidthItem < items[i].clientWidth) {
      maxWidthItem = items[i].clientWidth;
   }
}
console.log('maxHeightItem: ', maxHeightItem);
console.log('maxWidthItem: ', maxWidthItem);
for (let i = 0; i < items.length; i++) {
   // items[i].setAttribute("style", `height:${maxHeightItem}px`);
   items[i].setAttribute("style", `height:${maxHeightItem}px; width:${maxWidthItem}px`);
}

