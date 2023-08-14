export default class Repeater {
    private addTrigger:string = '.js-repeater-add-row';
    private container: string = '.js-repeater-container';

    public init(): void {
        const $addTrigger = document.querySelector(this.addTrigger);
        if( !$addTrigger ) return;

        const $container = document.querySelector(this.container);
        if( !$container ) return;

        $addTrigger.addEventListener( 'click', (e: Event) => {
            const $el = e.target as HTMLButtonElement;

            const templateId: string = $el.dataset.templateid;
            if( !templateId ) console.error( 'No template found');

            const template = document.getElementById( templateId ) as HTMLTemplateElement;
            const clone = template.content.cloneNode(true) as HTMLTemplateElement;

            //rewrite ids
            const count = $container.children.length;
            const $clonedFields = clone.querySelectorAll( '[id],[for]' );

            $clonedFields.forEach((el) => {
                if( el.id ) el.id = `${el.id}${count}`;
                if( el.hasAttribute('for') ) el.setAttribute( 'for', `${el.getAttribute( 'for' )}${count}` );
            });

            $container.append(clone);
        });
    }
}