import GameScene from '../Scenes/GameScene';
import StartScene from '@pubCore/Classes/BaseScenes/StartScene';

export const GameConfig: Phaser.Types.Core.GameConfig = {
    title: 'Roulette',
    url: 'https://wppromogames.com',
    version: '1.0',
    width: 800,
    height: 600,
    backgroundColor: '#fefefe',
    dom: {
        createContainer: true
    },
    type: Phaser.AUTO,
    scale: {
        mode: Phaser.Scale.FIT,
        autoCenter: Phaser.Scale.CENTER_BOTH,
    },
    parent: 'wppromogames_21',
    scene: [
        StartScene,
        GameScene,
    ],
    input: {
        keyboard: true
    },
    physics: {
        default: 'arcade',
        arcade: {
            debug: true,
            gravity: { y: 100 }
        }
    }
};