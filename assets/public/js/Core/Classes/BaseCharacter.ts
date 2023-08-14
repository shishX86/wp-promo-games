import 'phaser';

export default class BaseCharacter extends Phaser.Physics.Arcade.Sprite {
    private _hp: number = 0;

    constructor(scene: Phaser.Scene, x: number, y: number, texture: string, frame?: string | number) {
        super(scene, x, y, texture, frame);

        this.initBase();
    }

    // SETTERS / GETTERS
    
    /**
     * Character health setter
     * @param  {number} val Set the character health
     */
    set hp(val: number) {
        this._hp += val;
    }
    
    /**
     * @returns Character health
     */
    get hp(): number {
        return this._hp;
    }

    /**
     * Returns character physical body
     * @returns Phaser.Physics.Arcade.Body
     */
    get pBody(): Phaser.Physics.Arcade.Body {
        return this.body as Phaser.Physics.Arcade.Body;
    }

    // METHODS
    /**
     * Initialize Character
     * @returns void
     */
    private initBase(): void {
        this.scene.add.existing(this);
        this.scene.physics.add.existing(this);
    }

    /**
     * Changes Health and returns new value
     * @param  {number} delta adds this value to current
     * @returns number
     */
    public updateHP(delta: number): number {
        return this._hp += delta;
    }

    /**
     * Destroy game object
     * @returns void
     */
    public die(withAnimation?: boolean): void {
        // TODO: Implement this
    }

    /**
     * Flip controlling
     * @returns void
     */
    protected checkFlip(): void {
        if (this.body.velocity.x < 0) {
          this.setFlipX(true);
        } else {
          this.setFlipX(false);
        }
    }
}