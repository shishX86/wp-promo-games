import "phaser";

import { SceneNames } from "@pubRoot/Core/Enums/SceneNames";

export default class BootScene extends Phaser.Scene {
    private bg: Phaser.GameObjects.Sprite;

    constructor() {
        super(SceneNames.AGREEMENT_SCENE);
    }

    init() {
        
    }
}