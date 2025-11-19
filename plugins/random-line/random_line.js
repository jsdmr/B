document.addEventListener('DOMContentLoaded', () => {
    const widget = document.getElementById('random-line-plugin');
    if (!widget) return;

    const line = widget.dataset.line;
    const source = widget.dataset.source;
    const interval = parseInt(widget.dataset.interval, 10) || 12000;
    widget.querySelector('.line').textContent = line;
    widget.querySelector('.source').textContent = `Источник: ${source}`;

    const randomizePosition = () => {
        const bottom = 10 + Math.random() * 40;
        const left = 15 + Math.random() * 70;
        widget.style.bottom = `${bottom}%`;
        widget.style.left = `${left}%`;
    };

    const showFact = () => {
        randomizePosition();
        widget.classList.add('visible');
        setTimeout(() => widget.classList.remove('visible'), 4000);
    };

    let started = false;
    const startCycle = () => {
        if (started) return;
        started = true;
        showFact();
        setInterval(showFact, interval);
    };

    window.addEventListener('scroll', startCycle, { once: true });
});
