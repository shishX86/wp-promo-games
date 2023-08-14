import "phaser";

import { SceneNames } from "@pubRoot/Core/Enums/SceneNames";

export default class LeadersScene extends Phaser.Scene {
    private bg: Phaser.GameObjects.Sprite;

    constructor() {
        super(SceneNames.LEADERS_SCENE);
    }

    preload() {
        //this.load.image('bg', '../wp-content/plugins/wp-promo-games/assets/public/js/Games/Roulette/Assets/Images/bg.jpg');
    }

    create() {
        this.add.text(16, 16, SceneNames.LEADERS_SCENE, { fontSize: '32px', color: 'red' });
    }

    update() {
        //TODO add update
    }
}