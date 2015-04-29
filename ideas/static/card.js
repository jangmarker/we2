document.registerElement('i-card-h',  {
    prototype: Object.create(HTMLHeadingElement.prototype),
    extends: 'h2'
});
document.registerElement('i-card', {
    prototype: Object.create(HTMLDivElement.prototype)
});
document.registerElement('i-comment', {
    prototype: Object.create(HTMLDivElement.prototype)
});
document.registerElement('i-comment-content', {
    prototype: Object.create(HTMLDivElement.prototype)
});
document.registerElement('i-comment-meta', {
    prototype: Object.create(HTMLDivElement.prototype)
});
document.registerElement('i-aspect-reference', {
    prototype: Object.create(HTMLAnchorElement.prototype),
    extends: 'a'
});
document.registerElement('i-idea-reference', {
    prototype: Object.create(HTMLAnchorElement.prototype),
    extends: 'a'
});
document.registerElement('i-tag', {
    prototype: Object.create(HTMLAnchorElement.prototype),
    extends: 'a'
});