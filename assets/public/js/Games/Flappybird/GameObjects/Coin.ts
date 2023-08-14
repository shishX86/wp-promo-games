import 'phaser';

import BaseBonus from '@pubCore/Classes/BaseBonus';
import ScoreSingleton from '@pubRoot/Core/Classes/ScoreSingleton';

export default class Coin extends BaseBonus {
    constructor(scene: Phaser.Scene, x: number, y: number, texture: string, frame?: string | number) {
        super(scene, x, y, texture, frame);

        this.init();
    }

    private init() {
        this.deltaScore = 10;
        this.deltaHealth = 5;
        this.pBody.allowGravity = false;

        this.initAnimations();
    }

    private initAnimations() {
        this.scene.anims.create({
            key: 'bonusAnim',
            repeat: -1,
            frameRate: 20,
            frames: this.anims.generateFrameNames('bonusSheet', {start:0, end:7})
        });

        this.play('bonusAnim');
    }

    protected collect(): void{
        const score = ScoreSingleton.getInstance();
        score.updateScore(this.deltaScore);
    }
}