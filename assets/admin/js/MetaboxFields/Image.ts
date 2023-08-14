export default class Image {
    private wpImageFieldClass: string = '.js-wppgs-media-trigger';
    private wpImageInputClass: string = '.js-wppgs-media-url';
    private wpImagePreviewClass: string = '.js-wppgs-media-preview';

    public init(): void {
        this.initTriggers();
        this.initClearImage();
    }

    private initTriggers(): void {
        const $triggers = document.querySelectorAll(this.wpImageFieldClass);
        if(!$triggers || !$triggers.length) return;

        $triggers.forEach((el: Element) => {
            el.addEventListener('click', (e: Event) => {
                e.preventDefault();

                const $target = e.target as HTMLElement;

                const image = wp.media({ 
                    title: 'Upload Image',
                    multiple: false
                })
                .open()
                .on('select', (eWP: Event) => {
                    const $parent = $target.parentNode as HTMLElement;
                    const uploadedImage = image.state().get('selection').first();
                    const imageUrl: string|null = uploadedImage.toJSON().url;
                    
                    const $url: HTMLInputElement = $parent.querySelector(this.wpImageInputClass);
                    if(!$url) return;

                    const imagePreview: HTMLElement = $parent.querySelector(this.wpImagePreviewClass);
                    imagePreview.style.backgroundImage = `url(${imageUrl})`;
                    imagePreview.classList.add('active');

                    $url.value = imageUrl;
                });
            });
        });
    }

    private initClearImage() {
        const $previews: NodeList = document.querySelectorAll(this.wpImagePreviewClass);
        if(!$previews || !$previews.length) return;

        $previews.forEach((el: HTMLElement) => {
            el.addEventListener('click', (e: Event) => {
                el.style.backgroundImage =  '';
                el.classList.remove('active');

                const $input: HTMLInputElement = el.parentNode.querySelector(this.wpImageInputClass);
                $input.value = '';
            });
        });
    }
}