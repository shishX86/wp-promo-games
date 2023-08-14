import 'phaser';
import Game from "./Game";
import IStrategy from "@pubCore/Interfaces/IStrategy";
import { GameConfig } from "./Environment/GameConfig";
import { GameStrategiesEnum } from "@pubCore/Enums/GameStrategiesEnum";

export default class FlappyBirdStrategy implements IStrategy {
    private _id: number;
    private _slug: GameStrategiesEnum;
    private _game: Phaser.Game;
    private _gameConfig: Phaser.Types.Core.GameConfig;
    private _gameData: object;

    constructor(slug: GameStrategiesEnum) {
        this._slug = slug;
    }

    initGame(gameData: object, id: number): void {
        this._id = id;
        this._gameData = gameData;
        this._game = new Game(GameConfig, this);

        return;
    }

    //GETTERS
    get id(): number {
        return this._id;
    }

    get slug(): GameStrategiesEnum {
        return this._slug;
    }

    get gameConfig(): Phaser.Types.Core.GameConfig {
        return this._gameConfig;
    }

    get gameData(): object {
        return this._gameData;
    }
}