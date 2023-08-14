import 'phaser';
import BaseCharacter from '@pubCore/Classes/BaseCharacter';

export default class Player extends BaseCharacter {
    private speed: number = 200;
    //keys
    private keyLeft: Phaser.Input.Keyboard.Key;
    private keyRight: Phaser.Input.Keyboard.Key;
    private keyUp: Phaser.Input.Keyboard.Key;
    private keyDown: Phaser.Input.Keyboard.Key;
    private keySpace: Phaser.Input.Keyboard.Key;

    constructor(scene: Phaser.Scene, x: number, y: number, texture: string, frame?: string | number) {
        super(scene, x, y, texture, frame);

        this.init();
    }

    init() {
        this.hp = 100;        
        this.pBody.setSize(this.width/2, this.height/2);
        this.pBody.setCollideWorldBounds(true);
        this.pBody.gravity.y = 300;
        this.pBody.setBounce(.8, .8);
        
        //every frame update
        this.scene.events.on('update', () => { this.update()} );

        this.initAnimations();
        this.initInput();
    }

    private initAnimations() {
        this.scene.anims.create({
            key: 'charFlyAnim',
            repeat: -1,
            frameRate: 20,
            frames: this.anims.generateFrameNames('charSheet', {start:0, end:7})
        });

        this.play('charFlyAnim');
    }

    private initInput() {
        //keys
        this.keyLeft = this.scene.input.keyboard.addKey(Phaser.Input.Keyboard.KeyCodes.LEFT);
        this.keyRight = this.scene.input.keyboard.addKey(Phaser.Input.Keyboard.KeyCodes.RIGHT);
        this.keyUp = this.scene.input.keyboard.addKey(Phaser.Input.Keyboard.KeyCodes.UP);
        this.keyDown = this.scene.input.keyboard.addKey(Phaser.Input.Keyboard.KeyCodes.DOWN);
        this.keySpace = this.scene.input.keyboard.addKey(Phaser.Input.Keyboard.KeyCodes.SPACE)
    }

    /**
     * @param  {number} value? 
     * @returns void
     */
     public getDamage(value?: number): void {
        //TODO: get Damage or die condition
        this.scene.tweens.add({
            targets: this,
            duration: 100,
            repeat: 3,
            yoyo: true,
            alpha: 0.5,
            onStart: () => {
                if (value) {
                    this.hp -= value;
                }
            },
            onComplete: () => {
                this.setAlpha(1);
            },
        });
    }

    update(): void {
        if (this.keyUp.isDown) {
            this.body.velocity.y = -this.speed;
        }

        if (this.keyLeft.isDown) {
            this.body.velocity.x = -this.speed;
            this.checkFlip();
        }

        if (this.keyDown.isDown) {
            this.body.velocity.y = this.speed;
        }

        if (this.keyRight.isDown) {
            this.body.velocity.x = this.speed;
            this.checkFlip();
        }

        if(this.keySpace.isDown) {
            this.body.velocity.y = -300;
        }
    }
    
}