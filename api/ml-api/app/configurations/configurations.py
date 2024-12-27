from .interfaces import ConfigurationsABC
from .machine_learning.machine_learning_configurations import (
    MachineLearningConfigurations,
)


class Configurations(ConfigurationsABC):
    MachineLearning = MachineLearningConfigurations
