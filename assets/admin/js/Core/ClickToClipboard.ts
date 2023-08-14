interface ClipboardOptions {
    cont: undefined|string,
    el: undefined|string
}

export default class ClickToClipboard {
    private defaults: object = {
        cont:   '.js-wppgs-shortcode',
        el:     '.js-wppgs-shortcode-code'
    };

    private options: ClipboardOptions;
    
    public init(options={}): void {
        this.options = {...this.defaults, ...options} as ClipboardOptions;
        this.initListeners();
    }

    private initListeners(): void {
        const $conts = document.querySelectorAll(this.options.cont);
        if(!$conts || !$conts.length) return;

        $conts.forEach(($cont) => {
            $cont.addEventListener('click', (e: Event) => { 
                const $target = e.currentTarget as HTMLElement;
                
                const $el = $target.querySelector(this.options.el) as HTMLElement;
                if(!$el) return;

                if(navigator.clipboard) {
                    navigator.clipboard.writeText($el.innerText)
                } else {
                    document.execCommand('copy');
                }
            });
        });
    }
}