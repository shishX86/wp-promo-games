import { GameStrategiesEnum } from "@pubCore/Enums/GameStrategiesEnum";

/**
 * Inteerface for game strategies
 */
export default interface IStrategy {
    initGame(data: object, id: Number): void;

    //getters
    get id(): Number;
    get slug(): GameStrategiesEnum;
    get gameConfig(): Phaser.Types.Core.GameConfig;
    get gameData(): object;
}