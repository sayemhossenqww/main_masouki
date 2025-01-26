import { encrypt, decrypt } from "@/services/utils";

export const Menu = {
    set,
    get,
    menuExists,
    items,
    storageKey
};

const ITEMS = "_its";

/**
 * Get menu storage key.
 *
 * @return {number} key
 */
function storageKey() {
    return ITEMS;
}

/**
 * set the menu
 *   
 * @param menu Menu.
 */
function set(menu) {
    //console.time('setMenu');
    var _items = items();
    menu.forEach(function(category) {
        category.items.forEach(function(item) {
            let _item = _items.find(element => element.slug == item.slug);
            if (_item == undefined) {
                item.in_cart = false;
                item.quantity = 0;
                item.comment = "";
                item.services = [];
            } else {
                item.in_cart = _item.in_cart || false;
                item.quantity = _item.quantity || 0;
                item.comment = _item.comment || "";
                item.services = _items.services || [];
            }

        });
    });
    console.log(menu);
    localStorage.setItem(ITEMS, encrypt(JSON.stringify(menu)));
    //console.timeEnd('setMenu');
}

/**
 * Get the menu
 *   
 * @return {array} menu.
 */
function get() {
    try {
        return menuExists() ? JSON.parse(decrypt(localStorage.getItem(ITEMS))) : [];
    } catch {
        return [];
    }
}
/**
 * Get the menu items
 *   
 * @return {array} menu items.
 */
function items() {
    if (!menuExists()) return [];
    let items = [];
    get().forEach(category => items = items.concat(category.items));
    return items;
}
/**
 * Determine if menu exists in storage.
 *
 * @return {boolean} true or false
 */
function menuExists() {
    return !!localStorage.getItem(ITEMS);
}