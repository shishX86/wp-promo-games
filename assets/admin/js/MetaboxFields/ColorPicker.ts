/// <reference path="../Types/jquery.d.ts"/>

export default class ColorPicker {
    private wpColorFieldClass:string = '.js-wppgs-color-field';

    public init(): void {
        jQuery(this.wpColorFieldClass).wpColorPicker();
    }
}