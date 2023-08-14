import "phaser";
//core
import ScoreSingleton from '@pubCore/Classes/ScoreSingleton';
import { SceneNames } from "@pubRoot/Core/Enums/SceneNames";
//game objects
import Player from "../GameObjects/Player";
import Coin from "../GameObjects/Coin";

export default class GameScene extends Phaser.Scene {
    private player: Player;
    private bonus: Coin;
    private worldOffset: number = 20;

    private bg: Phaser.GameObjects.TileSprite;

    constructor() {
        super(SceneNames.GAME_SCENE);
    }

    preload() {
        this.load.image('bg', '../wp-content/plugins/wp-promo-games/assets/public/js/Games/Roulette/Assets/Images/bg.jpg');
        this.load.spritesheet('charSheet', '../wp-content/plugins/wp-promo-games/assets/public/js/Games/Roulette/Assets/Images/char.png', {frameWidth: 200, frameHeight : 135});
        this.load.spritesheet('bonusSheet', '../wp-content/plugins/wp-promo-games/assets/public/js/Games/Roulette/Assets/Images/coin.png', {frameWidth: 44, frameHeight : 40});
    }

    create() {
        this.createGameObjects();
    }

    update() {
        this.tilingBg();
    }

    private tilingBg(): void {
        this.bg.tilePositionX++;
    }

    private createGameObjects():void {
        this.bg = this.add.tileSprite(0, 0, this.sys.canvas.width, this.sys.canvas.height, 'bg').setOrigin(0);
        this.player = new Player(this, 100, 100, 'charSheet');
        this.randomBonusApear();
        //set current scene
        ScoreSingleton.getInstance(this);
    }

    private randomBonusApear(): void {
        const xPos = Phaser.Math.Between(this.worldOffset, this.sys.canvas.width - this.worldOffset);
        const yPos = Phaser.Math.Between(this.worldOffset, this.sys.canvas.height - this.worldOffset);

        this.bonus = new Coin(this, xPos, yPos, 'bonusSheet');
        this.physics.add.overlap(this.player, this.bonus, this.collectBonus.bind(this), null, this.scene);
    }

    private collectBonus(player:Player, bonus:Coin):void {
        bonus.destroy();
        this.randomBonusApear();
    }
}