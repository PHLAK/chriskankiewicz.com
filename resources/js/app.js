import Alpine from 'alpinejs';

Alpine.magic('scrollTo', () => (position) => {
    const [ url, offset ] = typeof position === 'string' ? ['#' + position, document.getElementById(position).offsetTop] : [location.pathname, position];

    history.pushState(null, url, url);
    scrollTo({ top: offset, behavior: 'smooth' });
});

Alpine.start();
