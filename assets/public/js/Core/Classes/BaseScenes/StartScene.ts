import "phaser";
import { SceneNames } from "@pubRoot/Core/Enums/SceneNames";
import Game from "@pubRoot/Games/Flappybird/Game";

export default class StartScene extends Phaser.Scene {
    private bg: Phaser.GameObjects.TileSprite;
    private assetsBaseUrl: string = '../wp-content/plugins/wp-promo-games/assets/public/js/Games/Roulette/Assets/Images';
    private triggerStart: string = '.js-wppgs-start-game';

    constructor() {
        super(SceneNames.START_SCENE);
    }

    preload() {
        this.load.image('bg_start', `${this.assetsBaseUrl}/start_bg.jpg`);
    }

    create() {
        this.initGameObjects();
        this.initHtmlUI();
        this.initStart();

        console.log((this.game as Game).strategy.gameData);
    }

    update() {
        this.bg.tilePositionX++;
    }

    initGameObjects() {
        this.bg = this.add.tileSprite(0, 0, this.sys.canvas.width, this.sys.canvas.height, 'bg_start').setOrigin(0);
        const txt = this.add.text(16, 16, SceneNames.START_SCENE, { fontSize: '32px', color: 'red' });
    }

    initHtmlUI() {
        const startForm: string = document.getElementById('wppgs_start_template_21').innerHTML;
        const form = this.add.dom(0, 0, 'div', {width: '100%', height: '100%'}).setHTML(startForm).setOrigin(0, 0);
    }

    initStart() {
        const trigger = document.querySelector(this.triggerStart);
        if( !trigger ) return;

        trigger.addEventListener('click', () => { 
            this.scene.start(SceneNames.GAME_SCENE);
        });
    }
}