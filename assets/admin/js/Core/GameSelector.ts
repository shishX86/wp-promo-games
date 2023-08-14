export default class GameSelector {
    private selectClass:string = '.js-game-strategy-select';
    private action? :string = null;
    private containerClass?: string = null;
    private postId?: string = null;

    private loadingContClass: string = '.wppgs-fieldgroup';
    private loadingClass: string = 'wppgs-loading';
    private isLoading: boolean = false;

    public init(): void {
        this.getDataAttrs();
        this.initListeners();
        this.initialFetch();
    }

    private getDataAttrs(): void {
        const $select:HTMLElement = document.querySelector(this.selectClass);
        if(!$select) return;

        this.action = $select.dataset.action;
        this.containerClass = $select.dataset.cont;
        this.postId = $select.dataset.postid;
    }

    private initListeners(): void {
        const $select:HTMLSelectElement = document.querySelector(this.selectClass);
        if(!$select) return;

        $select.addEventListener('change', (e: Event) => {
            const target = e.target as HTMLSelectElement;
            const value = target.value;
        
            this.fetchData(value);
        })
    }

    private initialFetch(): void {
        const $select:HTMLSelectElement = document.querySelector(this.selectClass);
        if(!$select) return;

        this.fetchData($select.value);
    }

    private async fetchData(value: string):Promise<void> {
        const container = document.querySelector(`.${this.containerClass}`) as HTMLElement;
        if( !container || this.isLoading ) return;

        this.startLoading();

        const formData = new FormData();
        formData.append('action', this.action);
        formData.append('gameindex', value);
        formData.append('postid', this.postId);

        try {

            const request = await fetch(window.ajaxurl, {
                method: 'POST',
                credentials: 'same-origin',
                headers: {
                    'Cache-Control': 'no-cache',
                },
                body: new URLSearchParams(formData as any)
            });
    
            const response = await request.json();
            container.innerHTML = response.data;

        } catch (e) {
            console.error(e);
            this.stopLoading();
        }

        this.stopLoading();
    }

    private startLoading() {
        const $select:HTMLSelectElement = document.querySelector(this.selectClass);
        if(!$select) return;

        const fieldsCont = document.querySelector(`.${this.containerClass}`) as HTMLElement;
        if( fieldsCont ) fieldsCont.classList.add(this.loadingClass);

        const cont = $select.closest(this.loadingContClass);
        if( cont ) cont.classList.add(this.loadingClass);
        
        this.isLoading = true;
    }

    private stopLoading() {
        const $select:HTMLSelectElement = document.querySelector(this.selectClass);
        if(!$select) return;

        const fieldsCont = document.querySelector(`.${this.containerClass}`) as HTMLElement;
        if( fieldsCont ) fieldsCont.classList.remove(this.loadingClass);

        const cont = $select.closest(this.loadingContClass);
        if( cont ) cont.classList.remove(this.loadingClass);
        
        this.isLoading = false;
    }
}