import Image from "./MetaboxFields/Image";
import GameSelector from "./Core/GameSelector";
import Repeater from "./MetaboxFields/Repeater";
import ColorPicker from "./MetaboxFields/ColorPicker";
import ClickToClipboard from "./Core/ClickToClipboard";

/**
 * Initial main application class
 */
class App {
    public init():void {
        const colorPickerController: ColorPicker = new ColorPicker();
        colorPickerController.init();

        const imageController: Image = new Image();
        imageController.init();

        const gameSelector: GameSelector = new GameSelector();
        gameSelector.init();

        const repeaterController: Repeater = new Repeater();
        repeaterController.init();

        const clickToClipboard: ClickToClipboard = new ClickToClipboard();
        clickToClipboard.init();
    }
}

/**
 * Document ready
 */
document.addEventListener('DOMContentLoaded', () => {
    const app:App = new App();
    app.init();
});