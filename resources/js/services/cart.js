import { encrypt, decrypt } from "@/services/utils";
import { Menu } from "./menu";

export const Cart = {
    add,
    remove,
    total,
    totalItems,
    isEmpty,
    items,
    clear,
    updateComment,
    increment,
    decrement
};

/**
 * Add new item to storage
 *   
 * @param {any} item the item to add.
 * @param {number} qty quantity.
 * @param {string} comment
 */
function add(item, qty, services, comment = "") {
    if (!Menu.menuExists()) return;
    let menu = Menu.get();
    console.log("MENU", menu);
    let cartItem = getItem(menu, item.slug);
    if (cartItem == undefined) return;
    cartItem.quantity += qty;
    cartItem.comment = comment;
    cartItem.in_cart = true;
    cartItem.services = services;
    localStorage.setItem(Menu.storageKey(), encrypt(JSON.stringify(menu)));
}

/**
 * Remove item from storage.
 *   
 * @param item the item to remove.
 */
function remove(item) {
    if (!Menu.menuExists()) return;
    let menu = Menu.get();
    let cartItem = getItem(menu, item.slug);
    if (cartItem == undefined) return;
    cartItem.quantity = 0;
    cartItem.services = [];
    cartItem.comment = "";
    cartItem.in_cart = false;
    localStorage.setItem(Menu.storageKey(), encrypt(JSON.stringify(menu)));
}

/**
 * Cart items.
 *
 * @return {array} items
 */
function items() {
    return Menu.items().filter(item => item.in_cart);
}

/**
 * Total cart amount.
 *
 * @return {number} total
 */
function total() {
    let total = 0;
    items().forEach(item => {
        let subTotal = parseFloat(item.base_price_usd);
        item.services.forEach((service) => {
            subTotal += parseFloat(service.price);
        })
        total += subTotal * parseInt(item.quantity)
    });
    return total;
}

/**
 * Determine if cart is empty.
 *
 * @return {boolean} true or false
 */
function isEmpty() {
    return totalItems() == 0;
}

/**
 * Total cart items.
 *
 * @return {number} length
 */
function totalItems() {
    let totalItems = 0;
    if (!Menu.menuExists()) return 0;
    let menu = Menu.get();
    menu.forEach(function(category) {
        category.items.forEach(function(item) {
            totalItems += item.quantity
        });
    });
    return totalItems;
}
/**
 * Remove all cart items from storage.
 *
 */
function clear() {
    if (!Menu.menuExists()) return;
    let menu = Menu.get();
    menu.forEach(function(category) {
        category.items.forEach(function(item) {
            item.in_cart = false;
            item.quantity = 0;
            item.services = [];
            item.comment = "";
        });
    });
    localStorage.setItem(Menu.storageKey(), encrypt(JSON.stringify(menu)));
}

/**
 * Update item comment.
 *   
 * @param item the item to update.
 */
function updateComment(item) {
    if (!Menu.menuExists()) return;
    let menu = Menu.get();
    let cartItem = getItem(menu, item.slug);
    if (cartItem == undefined) return;
    cartItem.comment = item.comment;
    localStorage.setItem(Menu.storageKey(), encrypt(JSON.stringify(menu)));
}

/**
 * Increment item quantity;
 *   
 * @param item the item to Increment.
 */
function increment(item) {

    if (!Menu.menuExists()) return;
    let menu = Menu.get();
    let cartItem = getItem(menu, item.slug);
    if (cartItem == undefined) return;
    if (cartItem.quantity == 100) return;
    cartItem.quantity += 1;
    localStorage.setItem(Menu.storageKey(), encrypt(JSON.stringify(menu)));
}

/**
 * Decrement item quantity;
 *   
 * @param item the item to Decrement.
 */
function decrement(item) {
    if (!Menu.menuExists()) return;
    let menu = Menu.get();
    let cartItem = getItem(menu, item.slug);
    if (cartItem == undefined) return;
    if (cartItem.quantity == 1) return;
    cartItem.quantity -= 1;
    localStorage.setItem(Menu.storageKey(), encrypt(JSON.stringify(menu)));
}
/**
 * Decrement item quantity;
 *   
 * @param menu Menu.
 * @param {string} slug Slug.
 * @return item
 */
function getItem(menu, slug) {
    return menu.find(c => c.items.some(i => i.slug == slug))
        .items.find((i => i.slug == slug));
}