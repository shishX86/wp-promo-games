import "phaser";

import { SceneNames } from "@pubRoot/Core/Enums/SceneNames";

export default class BootScene extends Phaser.Scene {
    private bg: Phaser.GameObjects.Sprite;

    constructor() {
        super(SceneNames.AGREEMENT_SCENE);
    }

    preload() {
        //this.load.image('bg', '../wp-content/plugins/wp-promo-games/assets/public/js/Games/Roulette/Assets/Images/bg.jpg');
    }

    create() {
        this.add.text(16, 16, SceneNames.AGREEMENT_SCENE, { fontSize: '32px', color: 'red' });
    }

    update() {
        //TODO add update
    }
}