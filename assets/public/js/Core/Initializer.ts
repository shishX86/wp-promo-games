import BaseGame from '@pubCore/BaseGame';

/**
 * Entry point for games.
 * Getting data for each game 
 * and initialize it
 */
export default class Initializer {
    private gameClassName: string = '.js-wppgs-game';
    private gameContainers: NodeList;
    
    /**
     * Initialize all games on current page
     * 
     * @returns void
     */
    init(): void {
        this.gameContainers = document.querySelectorAll(this.gameClassName);
        if (!this.gameContainers || !this.gameContainers.length) return;

        //init concrete game
        for (const gameCont of this.gameContainers) {
            this.fetchData(gameCont as HTMLElement)
        }
    }

    /**
     * Getting acossiated fields with 
     * current game from admin panel
     * 
     * @param el current game container with data-attributes
     * @returns 
     */
    private async fetchData(el: HTMLElement): Promise<void> {
        if (!el) return;

        this.startLoading(el);

        const action: string = el.dataset.action;
        const id: number = parseInt(el.dataset.id);
        const ajaxurl: string = el.dataset.ajaxurl;

        if (!action || !id) return;

        const formData: FormData = new FormData();
        formData.append('action', action);
        formData.append('gameId', String(id));
        formData.append('ajaxurl', ajaxurl);

        try {
            const request = await fetch(ajaxurl, {
                method: 'POST',
                credentials: 'same-origin',
                headers: {
                    'Cache-Control': 'no-cache',
                },
                body: new URLSearchParams(formData as any)
            });

            const response = await request.json();

            if (!response.data
                || response.data.status !== 'OK'
                || !response.data.data
                || !response.data.data.length) return;

            //Initialize current game
            const game = new BaseGame(response.data.data[0], id);
            game.init();

        } catch (e) {
            console.error(e);
            this.stopLoading(el);
        }

        this.stopLoading(el);
    }

    /**
     * Sets all params and classes for loading state
     * for current game container
     * 
     * @param cont game html container
     */
     private startLoading(cont: HTMLElement) {
        cont.classList.add('wppgs-loading');
    }

    /**
     * Remove all params and classes and params 
     * acossiated with loading state
     * 
     * @param cont game html container
     */
    private stopLoading(cont: HTMLElement) {
        cont.classList.remove('wppgs-loading');
    }
}