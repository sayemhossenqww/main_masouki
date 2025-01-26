import { AES, enc } from "crypto-js";

const KEY = "73460461-76b3-440f-bfd4-06b102344011";

/**
 * Format number to LL Currency.
 *
 * @param {number} number.
 * @return {string} formatted number.
 */
export function blr_money_format(number) {
    return "LL " + number.toLocaleString();
}
/**
 * Format number to USD Currency.
 *
 * @param {number} number.
 * @return {string} formatted number.
 */
export function usd_money_format(number) {
    return new Intl.NumberFormat("en-US", {
        style: "currency",
        currency: "USD",
    }).format(number);
}

/**
 * Get file size.
 *
 * @return {string} size
 */
export function filesize(size) {
    const i = Math.floor(Math.log(size) / Math.log(1024));
    return (
        (size / Math.pow(1024, i)).toFixed(2) * 1 +
        " " +
        ["B", "kB", "MB", "GB", "TB"][i]
    );
}

/**
 * Encrypts a message.
 *
 * @return {string} data
 */
export function encrypt(data) {
    return AES.encrypt(data, KEY).toString();
}

/**
 * Decrypts serialized ciphertext.
 *
 * @return {string} data
 */
export function decrypt(data) {
    return AES.decrypt(data, KEY).toString(enc.Utf8);
}

/**
 * Delay function.
 * @param {number} secondes.
 * @return {Promise} Promise
 */
export function delay(secondes) {
    var time = secondes * 1000;
    return new Promise((resolve) => setTimeout(resolve, time));
}

/**
 * Lazy load images.
 *
 * @return {LazyLoad} LazyLoad
 */
export function lazyLoadImages() {
    var aLazyLoad = new LazyLoad();
    aLazyLoad.update();
}
